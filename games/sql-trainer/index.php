<?php
/**
 * IT-Games: SQL-Trainer
 * SQL-Abfragen in Leveln üben. Die Übungsdatenbank läuft im Browser (SQLite über sql.js),
 * der Server wird dabei nicht abgefragt.
 */

require_once __DIR__ . '/../../config.php';
require_login();

$page_title = 'SQL-Trainer';
include __DIR__ . '/../../includes/header.php';
?>

<div class="layout-container">
    <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3"></div>
                <div class="col-md-8 col-lg-9">
                    <div id="sql-trainer"
                         data-user="<?= (int)$_SESSION['user_id'] ?>"
                         data-sqljs-path="/assets/js/vendor/sql.js-1.10.3/">

                        <div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-database me-2"></i>SQL-Trainer</h1>
                        </div>
                        <p class="text-muted">
                            Löse Aufgaben aus dem IT-Support der ByteBurg GmbH mit SQL. Deine Abfragen laufen in einer
                            Übungsdatenbank direkt in deinem Browser – du kannst nichts kaputt machen.
                        </p>

                        <div id="st-loading" class="alert alert-info">
                            <span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>SQL-Engine wird geladen …
                        </div>

                        <div class="row g-3">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-body pb-2">
                                        <div class="small fw-semibold mb-1" id="st-progress-text"></div>
                                        <div class="progress" role="progressbar" aria-label="Fortschritt" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar bg-success" id="st-progress-bar" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    <div class="list-group list-group-flush" id="st-levels"></div>
                                    <div class="card-footer bg-transparent">
                                        <button type="button" id="st-reset" class="btn btn-link btn-sm text-muted p-0">Fortschritt zurücksetzen</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                            <h2 class="h4 mb-1" id="st-title"></h2>
                                            <span class="badge text-bg-primary" id="st-topic"></span>
                                        </div>
                                        <p class="text-muted fst-italic" id="st-story"></p>
                                        <p class="fw-semibold mb-3" id="st-task"></p>

                                        <label for="st-editor" class="form-label small text-muted">
                                            Deine SQL-Abfrage (Strg + Enter zum Ausführen)
                                        </label>
                                        <textarea id="st-editor" class="form-control font-monospace" rows="6"
                                                  spellcheck="false" autocomplete="off" autocapitalize="off"
                                                  placeholder="SELECT …"></textarea>

                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            <button type="button" id="st-run" class="btn btn-primary" disabled>
                                                <i class="bi bi-play-fill me-1"></i>Ausführen
                                            </button>
                                            <button type="button" id="st-hint-btn" class="btn btn-outline-secondary">
                                                <i class="bi bi-lightbulb me-1"></i>Tipp
                                            </button>
                                            <button type="button" id="st-solution-btn" class="btn btn-outline-secondary" disabled>
                                                <i class="bi bi-eye me-1"></i>Lösung
                                            </button>
                                            <button type="button" id="st-next" class="btn btn-success ms-auto" hidden>
                                                Nächstes Level <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </div>

                                        <div id="st-hint" class="alert alert-info mt-3" hidden></div>
                                        <div id="st-feedback" class="alert mt-3" role="status" aria-live="polite" hidden></div>
                                        <div id="st-result" class="mt-3"></div>
                                    </div>
                                </div>

                                <details class="card mb-4">
                                    <summary class="card-header">Übungsdatenbank ansehen (Tabellen und Daten)</summary>
                                    <div class="card-body" id="st-schema"></div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="/assets/js/vendor/sql.js-1.10.3/sql-wasm.js"></script>
<script src="/assets/js/games/sql-trainer-levels.js"></script>
<script src="/assets/js/games/sql-trainer.js"></script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
