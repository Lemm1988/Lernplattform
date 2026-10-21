<?php
require_once '../config.php';
require_login();
$page_title = 'C – Programmiersprache';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid py-4 lang-page">
                <div class="d-flex align-items-center gap-3 pb-2 mb-4 border-bottom">
                    <i class="bi bi-file-earmark-code fs-1 text-primary"></i>
                    <div>
                        <h1 class="h2 mb-0">C</h1>
                        <p class="text-muted mb-0">Nah an der Hardware – die Grundlage von Betriebssystemen und Mikrocontrollern</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-xl-8">
                        <section class="mb-5">
                            <h2>Steckbrief</h2>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr><th class="w-25">Erschienen</th><td>1972 (Bell Labs, für das Betriebssystem Unix)</td></tr>
                                        <tr><th>Ausführung</th><td>kompiliert direkt in Maschinencode für eine bestimmte Plattform</td></tr>
                                        <tr><th>Typisierung</th><td>statisch, aber mit vielen impliziten Umwandlungen</td></tr>
                                        <tr><th>Paradigma</th><td>prozedural – keine Klassen, keine Objekte</td></tr>
                                        <tr><th>Einsatz</th><td>Betriebssystemkerne (Linux, Windows-Teile), Treiber, Mikrocontroller, Datenbank-Engines</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>C ist klein, schnell und gibt dir volle Kontrolle über den Speicher – und damit auch die volle Verantwortung.
                                Es gibt weder Garbage Collector noch Prüfung von Array-Grenzen.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Vom Quelltext zum Programm</h2>
                            <pre><code class="language-c">#include &lt;stdio.h&gt;          /* Präprozessor: Header der Standard-Ein-/Ausgabe einbinden */

int main(void) {
    printf("Hallo, Welt!\n");
    return 0;                   /* 0 = Programm erfolgreich beendet */
}</code></pre>
                            <pre><code class="language-bash">$ gcc -Wall -o hallo hallo.c     # kompilieren und linken
$ ./hallo
Hallo, Welt!</code></pre>
                            <p>Der Weg dahin hat vier Schritte: <strong>Präprozessor</strong> (ersetzt <code>#include</code> und <code>#define</code>)
                                → <strong>Compiler</strong> (erzeugt Assembler) → <strong>Assembler</strong> (Objektdatei) → <strong>Linker</strong>
                                (bindet Bibliotheken ein, erzeugt die ausführbare Datei).</p>
                        </section>

                        <section class="mb-5">
                            <h2>Datentypen, Schleifen und Funktionen</h2>
                            <pre><code class="language-c">#include &lt;stdio.h&gt;

#define ANZAHL 5

double mittelwert(const int werte[], int anzahl) {
    int summe = 0;
    for (int i = 0; i &lt; anzahl; i++) {
        summe += werte[i];
    }
    return (double) summe / anzahl;      /* Cast, sonst Ganzzahldivision! */
}

int main(void) {
    int temperaturen[ANZAHL] = {18, 21, 19, 24, 22};
    char einheit = 'C';                  /* einzelnes Zeichen, 1 Byte */

    printf("Mittel: %.1f %c\n", mittelwert(temperaturen, ANZAHL), einheit);   /* Mittel: 20.8 C */
    printf("int belegt hier %zu Byte\n", sizeof(int));
    return 0;
}</code></pre>
                            <p>Die Größe der Ganzzahltypen ist in C nur als Mindestgröße festgelegt. Wer exakte Breiten braucht
                                (z. B. bei Mikrocontrollern), nimmt <code>int8_t</code>, <code>uint16_t</code>, <code>int32_t</code> aus
                                <code>&lt;stdint.h&gt;</code>.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Zeiger (Pointer)</h2>
                            <p>Ein Zeiger speichert die <strong>Adresse</strong> einer anderen Variable. <code>&amp;x</code> liefert die Adresse von
                                <code>x</code>, <code>*p</code> greift auf den Wert an der Adresse in <code>p</code> zu. Damit kann eine Funktion
                                Variablen des Aufrufers verändern:</p>
                            <pre><code class="language-c">void tausche(int *a, int *b) {
    int hilf = *a;
    *a = *b;
    *b = hilf;
}

int main(void) {
    int x = 3, y = 7;
    tausche(&amp;x, &amp;y);               /* Adressen übergeben */
    printf("x=%d y=%d\n", x, y);    /* x=7 y=3 */
    return 0;
}</code></pre>
                            <p>Arrays und Zeiger hängen eng zusammen: Der Name eines Arrays steht für die Adresse seines ersten Elements.
                                Strings sind in C einfach <code>char</code>-Arrays, die mit dem Zeichen <code>'\0'</code> enden.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Dynamischer Speicher</h2>
                            <p>Speicher, dessen Größe erst zur Laufzeit feststeht, holst du mit <code>malloc</code> vom Heap und gibst ihn mit
                                <code>free</code> selbst wieder frei:</p>
                            <pre><code class="language-c">#include &lt;stdlib.h&gt;

int *messwerte = malloc(anzahl * sizeof(int));
if (messwerte == NULL) {
    fprintf(stderr, "Kein Speicher frei\n");
    return 1;
}
/* … messwerte[0] bis messwerte[anzahl - 1] benutzen … */
free(messwerte);
messwerte = NULL;          /* verhindert versehentliche Weiterverwendung */</code></pre>
                            <div class="alert alert-danger small">
                                <strong>Typische Fehler in C:</strong> Speicherleck (<code>free</code> vergessen), Zugriff nach <code>free</code>,
                                Schreiben über das Array-Ende hinaus (<em>Buffer Overflow</em>). Buffer Overflows gehören seit Jahrzehnten zu den
                                häufigsten Ursachen von Sicherheitslücken – sichere Funktionen wie <code>snprintf</code> und <code>fgets</code>
                                statt <code>sprintf</code> und <code>gets</code> helfen.
                            </div>
                        </section>

                        <section class="mb-5">
                            <h2>Übung</h2>
                            <p>Schreib eine Funktion <code>int maximum(const int werte[], int anzahl)</code>, die den größten Wert eines
                                Arrays zurückgibt.</p>
                            <details>
                                <summary>Lösung anzeigen</summary>
                                <pre><code class="language-c">int maximum(const int werte[], int anzahl) {
    int max = werte[0];
    for (int i = 1; i &lt; anzahl; i++) {
        if (werte[i] &gt; max) {
            max = werte[i];
        }
    }
    return max;
}</code></pre>
                            </details>
                        </section>
                    </div>

                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-mortarboard me-2"></i>Prüfungsbezug</h3>
                                <ul class="small mb-0">
                                    <li>Compiler vs. Interpreter, Phasen der Übersetzung</li>
                                    <li>Stack (lokale Variablen) vs. Heap (<code>malloc</code>)</li>
                                    <li>Buffer Overflow als Sicherheitsrisiko (LF4)</li>
                                    <li>Mikrocontroller-Programmierung (LF7)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-list-check me-2"></i>printf-Platzhalter</h3>
                                <table class="table table-sm small mb-0">
                                    <tbody>
                                        <tr><td><code>%d</code></td><td>Ganzzahl (<code>int</code>)</td></tr>
                                        <tr><td><code>%f</code>, <code>%.2f</code></td><td>Kommazahl, mit 2 Nachkommastellen</td></tr>
                                        <tr><td><code>%c</code></td><td>Zeichen</td></tr>
                                        <tr><td><code>%s</code></td><td>Zeichenkette</td></tr>
                                        <tr><td><code>%p</code></td><td>Adresse eines Zeigers</td></tr>
                                        <tr><td><code>%zu</code></td><td>Größe (<code>size_t</code>)</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
