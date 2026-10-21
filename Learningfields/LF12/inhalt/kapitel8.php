<?php
return [
    'title' => 'Bereitstellen mit Virtualisierung und Containern',
    'intro' => '„Bei mir läuft es aber!“ – Container lösen dieses Problem, indem sie die Anwendung samt Umgebung verpacken. Virtuelle Maschinen tun Ähnliches eine Ebene tiefer.',
    'goals' => [
        'Hypervisor Typ 1 und Typ 2 unterscheiden',
        'virtuelle Maschinen und Container vergleichen',
        'Image, Container, Registry und Volume erklären und ein Dockerfile lesen',
        'eine Anwendung mit Datenbank per Compose beschreiben und Orchestrierung einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Virtualisierung</h6>
<p>Ein <strong>Hypervisor</strong> teilt einen physischen Rechner in mehrere <strong>virtuelle Maschinen</strong> (VMs) auf. Jede VM hat virtuelle Hardware und ein eigenes
Gastbetriebssystem.</p>
<ul>
  <li><strong>Typ 1</strong> (bare metal) läuft direkt auf der Hardware – Rechenzentren und Server: VMware ESXi, Microsoft Hyper-V, KVM/Proxmox.</li>
  <li><strong>Typ 2</strong> (hosted) läuft als Programm auf einem normalen Betriebssystem – Arbeitsplatz, Schulung: VirtualBox, VMware Workstation.</li>
</ul>
<p>Vorteile: bessere Auslastung der Hardware, Snapshots vor riskanten Änderungen, schnelle Bereitstellung, Isolation. In der Cloud mietet man genau das als IaaS
(LF8 Kapitel 12).</p>

<h6>Container</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/vm-container.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links drei VMs mit je eigenem Gastbetriebssystem auf einem Hypervisor, rechts drei Container auf einer Container-Engine mit gemeinsamem Kernel">
  <figcaption class="figure-caption">VMs virtualisieren Hardware, Container das Betriebssystem</figcaption>
</figure>
<p>Ein <strong>Container</strong> enthält die Anwendung mit allen Bibliotheken und Einstellungen, teilt sich aber den Kernel des Host-Systems. Er ist deshalb klein,
startet in Sekunden und läuft auf dem Laptop, im Test und in der Produktion gleich.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>virtuelle Maschine</th><th>Container</th></tr></thead>
  <tbody>
    <tr><th>enthält</th><td>komplettes Gastbetriebssystem</td><td>nur Anwendung und Bibliotheken</td></tr>
    <tr><th>Größe, Start</th><td>Gigabyte, Minuten</td><td>Megabyte, Sekunden</td></tr>
    <tr><th>Isolation</th><td>stark (eigener Kernel)</td><td>geringer (gemeinsamer Kernel)</td></tr>
    <tr><th>Betriebssysteme</th><td>beliebig gemischt (Windows neben Linux)</td><td>passend zum Host-Kernel (Linux-Container brauchen Linux, unter Windows über WSL)</td></tr>
    <tr><th>typisch</th><td>Server konsolidieren, unterschiedliche Systeme</td><td>Microservices, gleiche Umgebung von Entwicklung bis Produktion</td></tr>
  </tbody>
</table>

<h6>Begriffe rund um Docker</h6>
<ul>
  <li><strong>Image</strong>: unveränderliche Vorlage aus Schichten (Basis-Betriebssystem, PHP, eigener Code).</li>
  <li><strong>Container</strong>: laufende Instanz eines Images. Aus einem Image können viele Container starten.</li>
  <li><strong>Dockerfile</strong>: Bauanleitung für ein Image.</li>
  <li><strong>Registry</strong>: Ablage für Images, z. B. Docker Hub oder eine firmeneigene Registry.</li>
  <li><strong>Volume</strong>: dauerhafter Speicher. Container sind flüchtig – wird einer gelöscht, ist alles darin weg, außer es liegt in einem Volume.</li>
</ul>
<pre class="bg-light border rounded p-3"><code># Dockerfile für eine PHP-Anwendung
# offizielles Image mit PHP und Apache
FROM php:8.2-apache
# Erweiterung für den MySQL-Zugriff
RUN docker-php-ext-install pdo_mysql
# eigenen Code ins Webverzeichnis kopieren
COPY . /var/www/html/
# der Container lauscht auf Port 80
EXPOSE 80</code></pre>
<p class="small text-muted">Kommentare stehen im Dockerfile immer in einer eigenen Zeile – ein <code>#</code> hinter einer Anweisung würde als Teil der Anweisung gelesen.</p>
<pre class="bg-light border rounded p-3"><code>docker build -t terminbuchung:1.0 .          # Image bauen
docker run -d -p 8080:80 terminbuchung:1.0   # starten, Port 8080 des Hosts → 80 im Container
docker ps                                    # laufende Container
docker logs &lt;container&gt;                      # Ausgaben ansehen
docker stop &lt;container&gt;</code></pre>

<h6>Mehrere Container mit Compose</h6>
<p>Webanwendung und Datenbank laufen in getrennten Containern. Eine <strong>Compose</strong>-Datei beschreibt beide zusammen:</p>
<pre class="bg-light border rounded p-3"><code>services:
  web:
    build: .
    ports:
      - "8080:80"
    environment:
      DB_HOST: db                       # Dienstname = Hostname im internen Netz
      DB_NAME: lernplattform
      DB_USER: app
      DB_PASSWORT: ${DB_PASSWORT}       # aus der nicht versionierten Datei .env
    depends_on:
      - db
  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: lernplattform
      MYSQL_USER: app
      MYSQL_PASSWORD: ${DB_PASSWORT}
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORT}
    volumes:
      - dbdaten:/var/lib/mysql          # Daten überleben das Löschen des Containers

volumes:
  dbdaten:</code></pre>
<p>Mit <code>docker compose up -d</code> starten beide Dienste. Zwei Fallen: <code>depends_on</code> regelt nur die <em>Startreihenfolge</em> – die Anwendung muss
damit umgehen, dass die Datenbank noch nicht bereit ist. Und Passwörter gehören in eine <code>.env</code>-Datei, die (wie <code>config.local.php</code>) nicht ins
Repository kommt (Kapitel 6).</p>

<h6>Orchestrierung</h6>
<p>Laufen viele Container auf vielen Servern, übernimmt ein <strong>Orchestrierer</strong> wie <strong>Kubernetes</strong> die Arbeit: Container verteilen, bei Last
zusätzliche starten (Skalierung), abgestürzte ersetzen (Selbstheilung), neue Versionen schrittweise ausrollen (Rolling Update, Kapitel 7). Für eine kleine
Werkstatt-Anwendung ist das überdimensioniert – ein einzelner Server oder ein verwalteter Dienst (PaaS) genügt.</p>
<div class="lf-merke"><strong>Merke:</strong> VM = virtuelle Hardware mit eigenem Betriebssystem; Container = isolierter Prozess mit eigenem Dateisystem auf einem
gemeinsamen Kernel. Images sind Vorlagen, Container laufende Instanzen, Volumes der dauerhafte Speicher.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Entwickler startet den Datenbank-Container neu, und alle Termine sind weg. Woran liegt das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Daten lagen im flüchtigen Dateisystem des Containers, nicht in einem Volume. Mit <code>volumes: - dbdaten:/var/lib/mysql</code> bleiben sie erhalten.</p>
</details>
<p>2. Eine alte Branchensoftware läuft nur unter Windows Server 2012, der Rest der Firma unter Linux. VM oder Container?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine virtuelle Maschine: Sie kann ein eigenes, abweichendes Betriebssystem ausführen. Container teilen sich den Kernel des Hosts.</p>
</details>
<p>3. Was bedeutet <code>-p 8080:80</code> bei <code>docker run</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Port 8080 des Host-Rechners wird auf Port 80 im Container weitergeleitet; die Anwendung ist im Browser unter <code>http://localhost:8080</code> erreichbar.</p>
</details>
INHALT,
    'summary' => [
        'Hypervisor Typ 1 läuft direkt auf der Hardware, Typ 2 auf einem Host-Betriebssystem.',
        'VMs virtualisieren Hardware mit eigenem Gast-OS; Container teilen sich den Kernel, sind klein und starten schnell.',
        'Image = Vorlage, Container = laufende Instanz, Dockerfile = Bauanleitung, Registry = Ablage, Volume = dauerhafter Speicher.',
        'Compose beschreibt mehrere Dienste (Web + Datenbank); Geheimnisse in .env außerhalb des Repositories.',
        'Kubernetes orchestriert viele Container: Verteilung, Skalierung, Selbstheilung, Rolling Updates.',
    ],
    'quiz' => [
        ['question' => 'Was unterscheidet einen Hypervisor Typ 1 von Typ 2?', 'answer' => 'Typ 1 läuft direkt auf der Hardware (bare metal), Typ 2 als Anwendung auf einem vorhandenen Betriebssystem.'],
        ['question' => 'Was ist der Unterschied zwischen Image und Container?', 'answer' => 'Ein Image ist die unveränderliche Vorlage; ein Container ist eine laufende Instanz eines Images.'],
        ['question' => 'Wozu dient ein Volume?', 'answer' => 'Es speichert Daten dauerhaft außerhalb des flüchtigen Container-Dateisystems, z. B. Datenbankdateien.'],
        ['question' => 'Nenne zwei Vorteile von Containern gegenüber VMs.', 'answer' => 'Z. B. geringere Größe, Start in Sekunden, gleiche Umgebung von Entwicklung bis Produktion, bessere Ausnutzung der Ressourcen.'],
    ],
];
