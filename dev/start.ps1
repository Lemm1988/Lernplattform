<#
.SYNOPSIS
    Startet die Lernplattform lokal: XAMPP-MySQL + Testdatenbank + PHP-Entwicklungsserver.

.EXAMPLE
    .\dev\start.ps1                # starten (Datenbank wird beim ersten Mal angelegt)
    .\dev\start.ps1 -Reset         # Testdatenbank neu aufbauen und starten
    .\dev\start.ps1 -Port 8001     # anderer Port
    .\dev\start.ps1 -OnlyDatabase  # nur MySQL + Testdatenbank vorbereiten, keinen Webserver starten
#>
param(
    [switch]$Reset,
    [int]$Port = 8000,
    [switch]$NoBrowser,
    [switch]$OnlyDatabase
)

$ErrorActionPreference = 'Stop'
[Console]::OutputEncoding = [Text.Encoding]::UTF8

$root   = Split-Path -Parent $PSScriptRoot
$xampp  = if ($env:XAMPP_HOME) { $env:XAMPP_HOME } else { 'C:\xampp' }
$php    = Join-Path $xampp 'php\php.exe'
$mysqld = Join-Path $xampp 'mysql\bin\mysqld.exe'
$myIni  = Join-Path $xampp 'mysql\bin\my.ini'

function Test-Port([int]$p) {
    [bool](Get-NetTCPConnection -LocalPort $p -State Listen -ErrorAction SilentlyContinue)
}

if (-not (Test-Path $php)) {
    Write-Host "PHP nicht gefunden: $php`nIst XAMPP installiert? Bei anderem Pfad die Umgebungsvariable XAMPP_HOME setzen." -ForegroundColor Red
    exit 1
}

function Wait-ForMySql([int]$seconds) {
    for ($i = 0; $i -lt $seconds * 2 -and -not (Test-Port 3306); $i++) { Start-Sleep -Milliseconds 500 }
    Test-Port 3306
}

function Show-MySqlLog {
    $log = Join-Path $xampp 'mysql\data\mysql_error.log'
    if (Test-Path $log) {
        Write-Host "`nLetzte Einträge aus $log :" -ForegroundColor Yellow
        Get-Content $log -Tail 12 | ForEach-Object { Write-Host "  $_" }
    }
}

# 1. MySQL aus XAMPP starten, falls es nicht schon läuft (z. B. über das XAMPP Control Panel)
if (-not (Test-Port 3306)) {
    # Ein MySQL-Prozess ohne offenen Port startet gerade (Wiederherstellung) – oder hängt
    $existing = Get-Process mysqld -ErrorAction SilentlyContinue
    if ($existing) {
        Write-Host 'MySQL-Prozess gefunden, der noch keine Verbindungen annimmt. Warte bis zu 30 Sekunden ...' -ForegroundColor Yellow
        if (-not (Wait-ForMySql 30)) {
            Write-Host ("MySQL hängt (Prozess mysqld.exe, PID " + ($existing.Id -join ', ') + ").`n" +
                "Bitte im XAMPP Control Panel bei MySQL auf 'Stop' klicken oder im Task-Manager 'mysqld.exe' beenden,`n" +
                "dann die Plattform erneut starten.") -ForegroundColor Red
            Show-MySqlLog
            exit 1
        }
    } else {
        Write-Host 'Starte MySQL (XAMPP) ...'
        # Über WMI starten: MySQL läuft dann unabhängig vom VS-Code-Terminal weiter und wird
        # beim Beenden des Tasks nicht hart abgewürgt (das würde bei jedem Start eine Wiederherstellung erzwingen)
        $commandLine = "`"$mysqld`" --defaults-file=`"$myIni`" --standalone"
        $null = Invoke-CimMethod -ClassName Win32_Process -MethodName Create -Arguments @{
            CommandLine      = $commandLine
            CurrentDirectory = (Split-Path $mysqld)
        }
        if (-not (Wait-ForMySql 30)) {
            Write-Host 'MySQL startet nicht. Bitte im XAMPP Control Panel MySQL starten und die Logs ansehen.' -ForegroundColor Red
            Show-MySqlLog
            exit 1
        }
    }
}
Write-Host 'MySQL läuft.' -ForegroundColor Green

# 2. Testdatenbank anlegen (bzw. mit -Reset neu aufbauen)
$setupArgs = @(Join-Path $root 'dev\setup_db.php')
if ($Reset) { $setupArgs += '--reset' }
& $php @setupArgs
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }
if ($OnlyDatabase) { exit 0 }

# 3. PHP-Entwicklungsserver starten
if (Test-Port $Port) {
    Write-Host "Port $Port ist belegt. Läuft die Plattform schon? Sonst anderen Port wählen: dev\start.ps1 -Port 8001" -ForegroundColor Yellow
    exit 1
}
$url = "http://localhost:$Port/"
Write-Host "`nLernplattform läuft unter $url  (beenden mit Strg+C)`n" -ForegroundColor Cyan
if (-not $NoBrowser) { Start-Process $url }
& $php -S "localhost:$Port" -t $root
