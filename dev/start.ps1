<#
.SYNOPSIS
    Startet die Lernplattform lokal: XAMPP-MySQL + Testdatenbank + PHP-Entwicklungsserver.

.EXAMPLE
    .\dev\start.ps1             # starten (Datenbank wird beim ersten Mal angelegt)
    .\dev\start.ps1 -Reset      # Testdatenbank neu aufbauen und starten
    .\dev\start.ps1 -Port 8001  # anderer Port
#>
param(
    [switch]$Reset,
    [int]$Port = 8000,
    [switch]$NoBrowser
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

# 1. MySQL aus XAMPP starten, falls es nicht schon läuft (z. B. über das XAMPP Control Panel)
if (-not (Test-Port 3306)) {
    Write-Host 'Starte MySQL (XAMPP) ...'
    Start-Process -FilePath $mysqld -ArgumentList "--defaults-file=`"$myIni`"", '--standalone' -WindowStyle Hidden
    for ($i = 0; $i -lt 40 -and -not (Test-Port 3306); $i++) { Start-Sleep -Milliseconds 500 }
    if (-not (Test-Port 3306)) {
        Write-Host 'MySQL startet nicht. Bitte im XAMPP Control Panel MySQL starten und die Logs ansehen.' -ForegroundColor Red
        exit 1
    }
}
Write-Host 'MySQL läuft.' -ForegroundColor Green

# 2. Testdatenbank anlegen (bzw. mit -Reset neu aufbauen)
$setupArgs = @(Join-Path $root 'dev\setup_db.php')
if ($Reset) { $setupArgs += '--reset' }
& $php @setupArgs
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

# 3. PHP-Entwicklungsserver starten
if (Test-Port $Port) {
    Write-Host "Port $Port ist belegt. Läuft die Plattform schon? Sonst anderen Port wählen: dev\start.ps1 -Port 8001" -ForegroundColor Yellow
    exit 1
}
$url = "http://localhost:$Port/"
Write-Host "`nLernplattform läuft unter $url  (beenden mit Strg+C)`n" -ForegroundColor Cyan
if (-not $NoBrowser) { Start-Process $url }
& $php -S "localhost:$Port" -t $root
