<?php
return [
    'title' => 'Linux-Server: Shell, Rechte, Dienste und Webserver',
    'intro' => 'Die meisten Server im Internet laufen unter Linux. Wer Dienste bereitstellt, muss sich in der Shell zurechtfinden: Dateien, Benutzer und Rechte verwalten, Pakete installieren, Dienste steuern, per SSH sicher zugreifen und einen Webserver einrichten.',
    'goals' => [
        'sich im Linux-Verzeichnisbaum orientieren und grundlegende Shell-Befehle anwenden',
        'Benutzer, Gruppen und Dateirechte (symbolisch und oktal) verwalten',
        'Pakete installieren und Dienste mit systemctl steuern',
        'SSH mit Schlüsseln einrichten und absichern',
        'einen Apache-VirtualHost anlegen und Fehler über Logs finden',
    ],
    'content' => <<<'INHALT'
<h6>Verzeichnisse</h6>
<p>Linux kennt keine Laufwerksbuchstaben. Alles hängt in einem Baum unter <code>/</code>, auch weitere Festplatten (sie werden an einer Stelle des Baums <em>eingehängt</em>).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/linux-verzeichnisse.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Verzeichnisbaum: /etc Konfiguration, /home Benutzer, /root, /var mit Logs und Webseiten, /usr Programme, /tmp, /dev, /proc, /boot">
  <figcaption class="figure-caption">Wo was liegt – nach dem Filesystem Hierarchy Standard</figcaption>
</figure>

<h6>Die wichtigsten Befehle</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Befehl</th><th>Wirkung</th></tr></thead>
  <tbody>
    <tr><td><code>pwd</code>, <code>cd /var/log</code>, <code>cd ..</code>, <code>cd ~</code></td><td>aktuelles Verzeichnis anzeigen, wechseln (eine Ebene hoch, ins Home)</td></tr>
    <tr><td><code>ls -la</code></td><td>Inhalt mit Details und versteckten Dateien (beginnen mit Punkt)</td></tr>
    <tr><td><code>mkdir -p a/b/c</code>, <code>touch datei</code></td><td>Verzeichnisse samt Zwischenebenen anlegen, leere Datei anlegen</td></tr>
    <tr><td><code>cp -r quelle ziel</code>, <code>mv alt neu</code>, <code>rm -r verz</code></td><td>kopieren, verschieben/umbenennen, löschen – ohne Papierkorb!</td></tr>
    <tr><td><code>cat</code>, <code>less</code>, <code>tail -f datei</code></td><td>Datei ausgeben, seitenweise lesen, neue Zeilen live verfolgen</td></tr>
    <tr><td><code>grep -i "fehler" datei</code></td><td>Zeilen mit einem Suchmuster finden</td></tr>
    <tr><td><code>find /var/www -name "*.php"</code></td><td>Dateien suchen</td></tr>
    <tr><td><code>nano datei</code></td><td>Datei im Terminal bearbeiten</td></tr>
    <tr><td><code>sudo befehl</code></td><td>Befehl mit Administratorrechten ausführen</td></tr>
    <tr><td><code>man befehl</code>, <code>befehl --help</code></td><td>Hilfe</td></tr>
  </tbody>
</table>
<p>Befehle lassen sich verketten: <code>|</code> leitet die Ausgabe weiter (<code>ls -l /etc | grep ssh</code>), <code>&gt;</code> schreibt sie in eine Datei und überschreibt sie dabei,
<code>&gt;&gt;</code> hängt an.</p>

<h6>Benutzer, Gruppen und Rechte</h6>
<p>Benutzer stehen in <code>/etc/passwd</code>, ihre Passwort-Hashes in <code>/etc/shadow</code> (nur für root lesbar), Gruppen in <code>/etc/group</code>.</p>
<pre><code>sudo useradd -m -s /bin/bash anna    # Benutzer mit Home-Verzeichnis und Shell
sudo passwd anna                     # Passwort setzen
sudo usermod -aG www-data anna       # zusätzlich in Gruppe www-data aufnehmen
id anna                              # Benutzer- und Gruppen-IDs anzeigen</code></pre>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/linux-rechte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="-rwxr-x--- zerlegt: Besitzer rwx = 7, Gruppe r-x = 5, Andere --- = 0, also chmod 750; Tabelle der Bedeutung von r, w, x bei Dateien und Verzeichnissen">
  <figcaption class="figure-caption">Drei Gruppen zu je drei Rechten: r = 4, w = 2, x = 1</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Oktal</th><th>Anzeige</th><th>typisch für</th></tr></thead>
  <tbody>
    <tr><td>755</td><td><code>rwxr-xr-x</code></td><td>Programme, Verzeichnisse</td></tr>
    <tr><td>644</td><td><code>rw-r--r--</code></td><td>normale Dateien, z. B. Webseiten</td></tr>
    <tr><td>640</td><td><code>rw-r-----</code></td><td>Konfiguration mit Passwörtern, die eine Gruppe lesen muss</td></tr>
    <tr><td>600</td><td><code>rw-------</code></td><td>private Schlüssel, nur der Besitzer</td></tr>
    <tr><td>1777</td><td><code>rwxrwxrwt</code></td><td><code>/tmp</code>: alle dürfen schreiben, aber nur eigene Dateien löschen (Sticky Bit)</td></tr>
  </tbody>
</table>
<pre><code>chmod 750 backup.sh             # oktal
chmod u+x,o-r skript.sh         # symbolisch: Besitzer +ausführen, Andere -lesen
sudo chown -R anna:www-data /var/www/projekt   # Besitzer und Gruppe ändern</code></pre>
<p>Neue Dateien bekommen ihre Rechte über die <strong>umask</strong>: Bei 022 entstehen Dateien mit 644 und Verzeichnisse mit 755.</p>
<div class="lf-merke"><strong>Merke:</strong> Nie „zur Sicherheit“ <code>chmod 777</code> – damit darf jeder Benutzer und jeder kompromittierte Dienst die Dateien ändern.
Webserver-Dateien gehören einem Deploy-Benutzer; der Webserver (<code>www-data</code>) braucht meist nur Leserechte.</div>

<h6>Pakete und Dienste</h6>
<pre><code>sudo apt update                  # Paketlisten aktualisieren (Debian/Ubuntu)
sudo apt upgrade                 # installierte Pakete aktualisieren
sudo apt install apache2         # Paket installieren (Red Hat/Alma: dnf install httpd)

sudo systemctl status apache2    # läuft der Dienst? letzte Logzeilen
sudo systemctl restart apache2   # neu starten
sudo systemctl reload apache2    # Konfiguration neu laden, ohne Verbindungen zu trennen
sudo systemctl enable apache2    # beim Booten automatisch starten
journalctl -u apache2 --since today   # Logs des Dienstes</code></pre>

<h6>Netzwerk unter Linux</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Befehl</th><th>zeigt</th></tr></thead>
  <tbody>
    <tr><td><code>ip a</code></td><td>Interfaces und Adressen (ersetzt <code>ifconfig</code>)</td></tr>
    <tr><td><code>ip r</code></td><td>Routingtabelle, Default-Gateway</td></tr>
    <tr><td><code>ss -tulpn</code></td><td>offene TCP/UDP-Ports und welches Programm lauscht</td></tr>
    <tr><td><code>ping -c 4 ziel</code>, <code>traceroute ziel</code></td><td>Erreichbarkeit, Weg</td></tr>
    <tr><td><code>dig www.example.org</code></td><td>DNS-Abfrage</td></tr>
    <tr><td><code>curl -I https://www.example.org</code></td><td>HTTP-Antwortkopf eines Webservers</td></tr>
    <tr><td><code>sudo ufw allow 22/tcp</code>, <code>sudo ufw enable</code></td><td>Host-Firewall (Ubuntu): Port freigeben, einschalten</td></tr>
  </tbody>
</table>

<h6>SSH</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/ssh-schluessel.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Privater Schlüssel bleibt auf dem Admin-PC, der öffentliche liegt in authorized_keys auf dem Server; der Client signiert, der Server prüft">
  <figcaption class="figure-caption">Anmeldung mit Schlüsselpaar statt Passwort</figcaption>
</figure>
<p>Absicherung in <code>/etc/ssh/sshd_config</code>: <code>PasswordAuthentication no</code>, <code>PermitRootLogin no</code>, Zugriff in der Firewall auf das Admin-Netz beschränken,
dazu <em>fail2ban</em>, das IP-Adressen nach mehreren Fehlversuchen sperrt. Vor dem Abschalten des Passwort-Logins unbedingt prüfen, ob die Schlüsselanmeldung funktioniert –
sonst sperrt man sich aus.</p>

<h6>Apache: eine Website bereitstellen</h6>
<p>Unter Debian/Ubuntu bekommt jede Website eine eigene Datei in <code>/etc/apache2/sites-available/</code>:</p>
<pre><code>&lt;VirtualHost *:80&gt;
    ServerName www.example.org
    DocumentRoot /var/www/example
    ErrorLog ${APACHE_LOG_DIR}/example_error.log
    CustomLog ${APACHE_LOG_DIR}/example_access.log combined
&lt;/VirtualHost&gt;</code></pre>
<pre><code>sudo a2ensite example.conf        # Website aktivieren
sudo apachectl configtest         # Syntax prüfen – vor jedem Reload!
sudo systemctl reload apache2
sudo certbot --apache -d www.example.org   # kostenloses TLS-Zertifikat von Let's Encrypt</code></pre>
<p>Über <code>ServerName</code> unterscheidet Apache mehrere Websites auf derselben IP-Adresse (namensbasierte virtuelle Hosts); der Browser schickt den Namen im HTTP-Header <code>Host</code> mit.</p>

<h6>Logs und Zeitpläne</h6>
<ul>
  <li><code>/var/log/syslog</code> (bzw. <code>journalctl</code>): Systemmeldungen; <code>/var/log/auth.log</code>: Anmeldungen und <code>sudo</code>; <code>/var/log/apache2/</code>: Zugriffe und Fehler.</li>
  <li><code>grep "Failed password" /var/log/auth.log</code> zeigt fehlgeschlagene SSH-Anmeldungen.</li>
  <li><strong>cron</strong> führt Aufgaben regelmäßig aus. Eintragen mit <code>crontab -e</code>. Die fünf Felder: Minute, Stunde, Tag, Monat, Wochentag (0 und 7 = Sonntag).</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Eintrag</th><th>bedeutet</th></tr></thead>
  <tbody>
    <tr><td><code>0 2 * * * /usr/local/bin/backup.sh</code></td><td>täglich um 2:00 Uhr</td></tr>
    <tr><td><code>*/15 * * * * /usr/local/bin/check.sh</code></td><td>alle 15 Minuten</td></tr>
    <tr><td><code>30 6 * * 1-5 /usr/local/bin/bericht.sh</code></td><td>montags bis freitags um 6:30 Uhr</td></tr>
    <tr><td><code>0 0 1 * * /usr/local/bin/monat.sh</code></td><td>am Ersten jedes Monats um Mitternacht</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Skript soll für den Besitzer les-, schreib- und ausführbar sein, für die Gruppe les- und ausführbar, für Andere gar nicht. Welcher Befehl?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>chmod 750 skript.sh</code> (7 = 4+2+1, 5 = 4+1, 0).</p>
</details>
<p>2. <code>ls -l</code> zeigt <code>-rw-r----- 1 root www-data 812 config.php</code>. Wer darf was?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Oktal 640. root darf lesen und schreiben, die Gruppe www-data (also der Webserver) darf lesen, alle anderen nichts – passend für eine Konfiguration mit Datenbankpasswort.</p>
</details>
<p>3. Schreibe einen cron-Eintrag, der <code>/usr/local/bin/sync.sh</code> an jedem Werktag um 18:30 Uhr startet.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>30 18 * * 1-5 /usr/local/bin/sync.sh</code></p>
</details>
<p>4. Nach einer Änderung an der Website-Konfiguration ist die Seite nicht mehr erreichbar. Wie gehst du vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>sudo apachectl configtest</code> (Syntaxfehler?), <code>systemctl status apache2</code> und <code>journalctl -u apache2</code> (läuft der Dienst?),
<code>ss -tlnp</code> (lauscht er auf 80/443?), das Error-Log der Website lesen, <code>sudo ufw status</code> prüfen. Danach Fehler beheben und <code>reload</code>.</p>
</details>
<p>5. SSH soll nur aus dem Admin-Netz 192.168.99.0/24 erreichbar sein. Welche ufw-Regel?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>sudo ufw allow from 192.168.99.0/24 to any port 22 proto tcp</code> – und keine allgemeine Freigabe für Port 22. Die Standardrichtlinie für eingehenden Verkehr bleibt <em>deny</em>.</p>
</details>
INHALT,
    'summary' => [
        'Alles liegt unter /: Konfiguration in /etc, Logs in /var/log, Webseiten in /var/www, Benutzer in /home.',
        'Rechte für Besitzer, Gruppe und Andere: r = 4, w = 2, x = 1; z. B. 755, 644, 640, 600.',
        'apt installiert Pakete, systemctl steuert Dienste, journalctl zeigt ihre Logs.',
        'SSH mit Schlüsselpaar: privater Schlüssel bleibt beim Client, öffentlicher in authorized_keys; Passwort- und root-Login abschalten.',
        'Apache: VirtualHost je Website, vor dem Reload apachectl configtest; cron für wiederkehrende Aufgaben.',
    ],
    'quiz' => [
        ['question' => 'Welche Oktalzahl entspricht rw-r--r--?', 'answer' => '644'],
        ['question' => 'In welchem Verzeichnis liegen Konfigurationsdateien?', 'answer' => 'In /etc.'],
        ['question' => 'Mit welchem Befehl sorgst du dafür, dass ein Dienst beim Booten startet?', 'answer' => 'sudo systemctl enable dienstname'],
        ['question' => 'Wo liegt der öffentliche Schlüssel auf dem Server?', 'answer' => 'In ~/.ssh/authorized_keys des Benutzers.'],
        ['question' => 'Was bedeutet der cron-Eintrag 0 2 * * *?', 'answer' => 'Täglich um 2:00 Uhr.'],
    ],
];
