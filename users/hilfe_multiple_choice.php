<?php
require_once '../config.php';
require_once '../includes/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$page_title = "Hilfe - Multiple-Choice-Fragen";
include '../includes/header.php';
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h2><i class="bi bi-question-circle"></i> Multiple-Choice-Fragen - Benutzerhandbuch</h2>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info">
                        <strong>Neu!</strong> Unser Quiz-System unterstützt jetzt Multiple-Choice-Fragen, bei denen Sie mehrere richtige Antworten auswählen können.
                    </div>

                    <h3>Fragetypen verstehen</h3>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5><i class="bi bi-circle"></i> Single-Choice-Fragen</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Erkennungsmerkmale:</strong></p>
                                    <ul>
                                        <li>Runde Auswahlfelder (Radiobuttons)</li>
                                        <li>Nur eine Antwort kann ausgewählt werden</li>
                                        <li>Traditioneller Fragetyp</li>
                                    </ul>
                                    <div class="example-box p-3 bg-light border rounded">
                                        <p><strong>Beispiel:</strong></p>
                                        <p>Was ist die Hauptstadt von Deutschland?</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="example1" disabled>
                                            <label class="form-check-label">Berlin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="example1" disabled>
                                            <label class="form-check-label">München</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="example1" disabled>
                                            <label class="form-check-label">Hamburg</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h5><i class="bi bi-check-square"></i> Multiple-Choice-Fragen</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Erkennungsmerkmale:</strong></p>
                                    <ul>
                                        <li>Eckige Auswahlfelder (Checkboxen)</li>
                                        <li>Mehrere Antworten können ausgewählt werden</li>
                                        <li>Neuer Fragetyp</li>
                                    </ul>
                                    <div class="example-box p-3 bg-light border rounded">
                                        <p><strong>Beispiel:</strong></p>
                                        <p>Welche der folgenden sind Programmiersprachen?</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled>
                                            <label class="form-check-label">PHP</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled>
                                            <label class="form-check-label">HTML</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled>
                                            <label class="form-check-label">JavaScript</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" disabled>
                                            <label class="form-check-label">Python</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>So beantworten Sie Multiple-Choice-Fragen</h3>
                    <div class="alert alert-warning">
                        <strong>Wichtig:</strong> Bei Multiple-Choice-Fragen müssen Sie <em>alle</em> richtigen Antworten auswählen, um die volle Punktzahl zu erhalten.
                    </div>

                    <h4>Schritt-für-Schritt Anleitung:</h4>
                    <ol class="list-group list-group-numbered mb-4">
                        <li class="list-group-item">
                            <strong>Frage lesen:</strong> Lesen Sie die Frage sorgfältig durch und achten Sie auf Schlüsselwörter wie "alle", "welche", "mehrere".
                        </li>
                        <li class="list-group-item">
                            <strong>Fragetyp erkennen:</strong> Schauen Sie auf die Auswahlfelder - Checkboxen bedeuten Multiple-Choice.
                        </li>
                        <li class="list-group-item">
                            <strong>Antworten auswählen:</strong> Klicken Sie auf alle Checkboxen, die richtige Antworten darstellen.
                        </li>
                        <li class="list-group-item">
                            <strong>Überprüfen:</strong> Vergewissern Sie sich, dass Sie alle richtigen Antworten ausgewählt haben.
                        </li>
                        <li class="list-group-item">
                            <strong>Weiter:</strong> Klicken Sie auf "Weiter" oder "Antwort absenden".
                        </li>
                    </ol>

                    <h3>Bewertungssystem</h3>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Single-Choice-Bewertung</h5>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><span class="badge bg-success">Richtig</span> = Volle Punktzahl</li>
                                        <li><span class="badge bg-danger">Falsch</span> = 0 Punkte</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Multiple-Choice-Bewertung</h5>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li><span class="badge bg-success">Alle richtig ausgewählt</span> = Volle Punktzahl</li>
                                        <li><span class="badge bg-warning">Teilweise richtig</span> = Anteilige Punkte</li>
                                        <li><span class="badge bg-danger">Falsche Auswahl</span> = Punktabzug</li>
                                        <li><span class="badge bg-secondary">Keine Auswahl</span> = 0 Punkte</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Code-Beispiele in Fragen</h3>
                    <p>Manche Fragen enthalten Code-Beispiele, die Ihnen helfen, die Frage zu verstehen:</p>
                    
                    <div class="example-box p-3 bg-light border rounded mb-3">
                        <p><strong>Beispiel einer Frage mit Code:</strong></p>
                        <p>Was gibt der folgende PHP-Code aus?</p>
                        <pre><code class="language-php">&lt;?php
$x = 5;
$y = 10;
echo $x + $y;
?&gt;</code></pre>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="code_example" disabled>
                            <label class="form-check-label">5</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="code_example" disabled>
                            <label class="form-check-label">10</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="code_example" disabled>
                            <label class="form-check-label">15</label>
                        </div>
                    </div>

                    <h3>Tipps für bessere Ergebnisse</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h5><i class="bi bi-lightbulb"></i> Allgemeine Tipps</h5>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Lesen Sie jede Frage vollständig</li>
                                        <li>Achten Sie auf Schlüsselwörter</li>
                                        <li>Nehmen Sie sich Zeit zum Nachdenken</li>
                                        <li>Überprüfen Sie Ihre Antworten</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h5><i class="bi bi-exclamation-triangle"></i> Multiple-Choice-Tipps</h5>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Wählen Sie ALLE richtigen Antworten</li>
                                        <li>Vermeiden Sie falsche Antworten</li>
                                        <li>Bei Unsicherheit: lieber weniger auswählen</li>
                                        <li>Nutzen Sie Ausschlussverfahren</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-4">Ergebnisse verstehen</h3>
                    <p>Nach Abschluss eines Quiz erhalten Sie detaillierte Ergebnisse:</p>
                    
                    <div class="example-box p-3 bg-light border rounded mb-3">
                        <h5>Beispiel-Ergebnis:</h5>
                        <div class="result-example">
                            <div class="question-result mb-3">
                                <h6>Frage 1: Welche sind Programmiersprachen? (Multiple-Choice)</h6>
                                <div class="answer-comparison">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Ihre Antworten:</strong>
                                            <ul class="list-unstyled">
                                                <li><i class="bi bi-check text-success"></i> PHP</li>
                                                <li><i class="bi bi-x text-danger"></i> HTML</li>
                                                <li><i class="bi bi-check text-success"></i> JavaScript</li>
                                                <li><i class="bi bi-dash text-muted"></i> Python (nicht ausgewählt)</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Richtige Antworten:</strong>
                                            <ul class="list-unstyled">
                                                <li><i class="bi bi-check text-success"></i> PHP</li>
                                                <li><i class="bi bi-x text-danger"></i> HTML (falsch)</li>
                                                <li><i class="bi bi-check text-success"></i> JavaScript</li>
                                                <li><i class="bi bi-check text-success"></i> Python</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="score-info mt-2">
                                        <span class="badge bg-warning">Teilpunkte: 1.5 von 2 Punkten</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Häufig gestellte Fragen (FAQ)</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    Wie erkenne ich Multiple-Choice-Fragen?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Multiple-Choice-Fragen haben eckige Checkboxen statt runde Radiobuttons. Sie können mehrere Antworten gleichzeitig auswählen.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    Was passiert, wenn ich nicht alle richtigen Antworten auswähle?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sie erhalten Teilpunkte basierend auf dem Anteil der richtig ausgewählten Antworten. Falsche Auswahlen führen zu Punktabzug.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    Kann ich meine Antworten ändern?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ja, Sie können Ihre Auswahl ändern, solange Sie die Frage noch nicht abgesendet haben. Klicken Sie einfach auf die Checkboxen, um sie zu aktivieren oder zu deaktivieren.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    Funktioniert das System auch ohne JavaScript?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ja, alle Funktionen arbeiten auch ohne JavaScript. Die Benutzeroberfläche ist möglicherweise weniger komfortabel, aber vollständig funktionsfähig.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                    Was bedeuten die verschiedenen Symbole in den Ergebnissen?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li><i class="bi bi-check text-success"></i> = Richtig ausgewählt</li>
                                        <li><i class="bi bi-x text-danger"></i> = Falsch ausgewählt</li>
                                        <li><i class="bi bi-dash text-muted"></i> = Richtige Antwort nicht ausgewählt</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-success mt-4">
                        <h5><i class="bi bi-info-circle"></i> Weitere Hilfe benötigt?</h5>
                        <p>Wenn Sie weitere Fragen haben, besuchen Sie unsere <a href="hilfe.php">allgemeine Hilfeseite</a> oder <a href="kontakt.php">kontaktieren Sie uns</a> direkt.</p>
                    </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<style>
.example-box {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}

.result-example {
    font-size: 0.9em;
}

.answer-comparison {
    background-color: white;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.question-result {
    border-left: 4px solid #007bff;
    padding-left: 15px;
}

.accordion-button:not(.collapsed) {
    background-color: #e7f3ff;
    color: #0056b3;
}
</style>

<script>
// Initialize Bootstrap components
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips if any
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>