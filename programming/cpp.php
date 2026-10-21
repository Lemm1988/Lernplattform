<?php
require_once '../config.php';
require_login();
$page_title = 'C++ – Programmiersprache';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid py-4 lang-page">
                <div class="d-flex align-items-center gap-3 pb-2 mb-4 border-bottom">
                    <i class="bi bi-braces-asterisk fs-1 text-primary"></i>
                    <div>
                        <h1 class="h2 mb-0">C++</h1>
                        <p class="text-muted mb-0">C plus Objektorientierung, Templates und eine mächtige Standardbibliothek</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-xl-8">
                        <section class="mb-5">
                            <h2>Steckbrief</h2>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr><th class="w-25">Erschienen</th><td>1985 als Erweiterung von C, seither regelmäßig neue Standards (C++11, 17, 20, 23)</td></tr>
                                        <tr><th>Ausführung</th><td>kompiliert in Maschinencode – keine virtuelle Maschine</td></tr>
                                        <tr><th>Typisierung</th><td>statisch und stark</td></tr>
                                        <tr><th>Paradigmen</th><td>prozedural, objektorientiert, generisch (Templates), funktional</td></tr>
                                        <tr><th>Einsatz</th><td>Spiele-Engines, Browser, Office-Software, Echtzeitsysteme, Hochleistungsrechnen</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>C++ ist weitgehend abwärtskompatibel zu C, ergänzt aber Klassen, Referenzen, Ausnahmen und die
                                <strong>Standard Template Library (STL)</strong>. Modernes C++ vermeidet manuelles <code>new</code>/<code>delete</code>
                                und überlässt die Speicherverwaltung Objekten, die sich selbst aufräumen.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Hallo Welt und Ein-/Ausgabe</h2>
                            <pre><code class="language-cpp">#include &lt;iostream&gt;
#include &lt;string&gt;

int main() {
    std::string name;
    std::cout &lt;&lt; "Wie heißt du? ";
    std::getline(std::cin, name);
    std::cout &lt;&lt; "Hallo, " &lt;&lt; name &lt;&lt; "!\n";
    return 0;
}</code></pre>
                            <p><code>std::cout</code> und <code>std::cin</code> sind Datenströme; <code>&lt;&lt;</code> schreibt hinein,
                                <code>&gt;&gt;</code> liest heraus. <code>std::string</code> verwaltet seinen Speicher selbst – anders als
                                <code>char</code>-Arrays in C.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Klassen</h2>
                            <pre><code class="language-cpp">#include &lt;iostream&gt;
#include &lt;stdexcept&gt;
#include &lt;string&gt;

class Konto {
public:
    Konto(std::string inhaber, double startguthaben)
        : inhaber_(std::move(inhaber)), saldo_(startguthaben) {}     // Initialisierungsliste

    void einzahlen(double betrag) {
        if (betrag &lt;= 0) {
            throw std::invalid_argument("Betrag muss positiv sein");
        }
        saldo_ += betrag;
    }

    double saldo() const { return saldo_; }     // const: ändert das Objekt nicht

private:
    std::string inhaber_;
    double saldo_;
};

int main() {
    Konto k("Weber", 100.0);
    k.einzahlen(50.0);
    std::cout &lt;&lt; k.saldo() &lt;&lt; '\n';        // 150
}</code></pre>
                            <p>Vererbung funktioniert wie in Java, allerdings muss eine Methode ausdrücklich <code>virtual</code> sein, damit
                                Polymorphie greift. Mit <code>override</code> lässt du den Compiler prüfen, ob du wirklich überschreibst.</p>
                            <pre><code class="language-cpp">class Form {
public:
    virtual double flaeche() const = 0;   // rein virtuell → abstrakte Klasse
    virtual ~Form() = default;            // virtueller Destruktor bei Basisklassen
};

class Kreis : public Form {
public:
    explicit Kreis(double r) : r_(r) {}
    double flaeche() const override { return 3.14159 * r_ * r_; }
private:
    double r_;
};</code></pre>
                        </section>

                        <section class="mb-5">
                            <h2>STL: Container und Algorithmen</h2>
                            <pre><code class="language-cpp">#include &lt;algorithm&gt;
#include &lt;map&gt;
#include &lt;numeric&gt;
#include &lt;vector&gt;

std::vector&lt;int&gt; punkte = {72, 95, 58, 81};          // dynamisches Array
std::sort(punkte.begin(), punkte.end());             // 58 72 81 95
int summe = std::accumulate(punkte.begin(), punkte.end(), 0);   // 306

std::map&lt;std::string, int&gt; lager;                    // sortierte Schlüssel-Wert-Paare
lager["Maus"] = 12;
lager["Tastatur"] = 4;

for (const auto&amp; [artikel, menge] : lager) {          // Range-based for (C++17)
    std::cout &lt;&lt; artikel &lt;&lt; ": " &lt;&lt; menge &lt;&lt; '\n';
}</code></pre>
                            <p><code>vector</code>, <code>map</code> und <code>string</code> sind <strong>Templates</strong>: derselbe Code
                                funktioniert für beliebige Typen, ähnlich wie Generics in Java – nur dass der Compiler für jeden Typ eigenen,
                                optimierten Code erzeugt.</p>
                        </section>

                        <section class="mb-5">
                            <h2>RAII und Smart Pointer</h2>
                            <p><strong>RAII</strong> (<em>Resource Acquisition Is Initialization</em>) ist das wichtigste Prinzip in C++: Ein Objekt
                                belegt eine Ressource im Konstruktor und gibt sie im Destruktor frei. Weil Destruktoren automatisch laufen, sobald
                                ein Objekt seinen Gültigkeitsbereich verlässt, kann man das Aufräumen nicht vergessen – auch nicht bei Exceptions.</p>
                            <pre><code class="language-cpp">#include &lt;memory&gt;

void verarbeite() {
    auto kreis = std::make_unique&lt;Kreis&gt;(2.0);    // besitzt das Objekt allein
    std::cout &lt;&lt; kreis-&gt;flaeche() &lt;&lt; '\n';
}   // hier wird das Objekt automatisch gelöscht – kein delete nötig

auto geteilt = std::make_shared&lt;Konto&gt;("Kaya", 0.0);   // Referenzzählung
auto zweiterBesitzer = geteilt;                      // Zähler = 2</code></pre>
                        </section>

                        <section class="mb-5">
                            <h2>Übung</h2>
                            <p>Lies Zahlen in einen <code>std::vector&lt;double&gt;</code> ein, bis 0 eingegeben wird, und gib
                                Minimum und Maximum aus. Tipp: <code>std::minmax_element</code>.</p>
                            <details>
                                <summary>Lösung anzeigen</summary>
                                <pre><code class="language-cpp">#include &lt;algorithm&gt;
#include &lt;iostream&gt;
#include &lt;vector&gt;

int main() {
    std::vector&lt;double&gt; werte;
    double x;
    while (std::cin &gt;&gt; x &amp;&amp; x != 0) {
        werte.push_back(x);
    }
    if (werte.empty()) {
        std::cout &lt;&lt; "Keine Werte\n";
        return 0;
    }
    auto [minIt, maxIt] = std::minmax_element(werte.begin(), werte.end());
    std::cout &lt;&lt; "Min: " &lt;&lt; *minIt &lt;&lt; ", Max: " &lt;&lt; *maxIt &lt;&lt; '\n';
}</code></pre>
                            </details>
                        </section>
                    </div>

                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-mortarboard me-2"></i>Prüfungsbezug</h3>
                                <ul class="small mb-0">
                                    <li>OOP-Begriffe: Klasse, Objekt, Kapselung, Vererbung, Polymorphie</li>
                                    <li>Konstruktor und Destruktor</li>
                                    <li>Kompilierte vs. interpretierte Sprachen</li>
                                    <li>UML-Klassendiagramm in Code umsetzen (LF11)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-arrow-left-right me-2"></i>C++ vs. Java</h3>
                                <table class="table table-sm small mb-0">
                                    <thead><tr><th></th><th>C++</th><th>Java</th></tr></thead>
                                    <tbody>
                                        <tr><td>Speicher</td><td>RAII, Smart Pointer</td><td>Garbage Collector</td></tr>
                                        <tr><td>Ausführung</td><td>Maschinencode</td><td>Bytecode in der JVM</td></tr>
                                        <tr><td>Mehrfachvererbung</td><td>ja</td><td>nur über Interfaces</td></tr>
                                        <tr><td>Polymorphie</td><td>mit <code>virtual</code></td><td>standardmäßig</td></tr>
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
