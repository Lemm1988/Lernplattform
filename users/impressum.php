<?php
require_once '../config.php';
$page_title = 'Impressum';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="container py-5">
                            <h1 class="mb-4"><i class="bi bi-info-circle me-2"></i>Impressum</h1>
                            
                            <div class="alert alert-info mb-4">
                                <h5><i class="bi bi-shield-check me-2"></i>Angaben gemäß § 5 TMG</h5>
                                <p class="mb-0">Diese Website wird betrieben von YourName als private Lernplattform für die Fachinformatiker-Ausbildung.</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-person me-2"></i>Anbieter</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>MaxMuster</strong><br>
                                                Musterstraße 123<br>
                                                12345 Musterstadt<br>
                                                Deutschland</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Kontakt</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>E-Mail:</strong> admin@YourDomain<br>
                                                <strong>Telefon:</strong> 000-000-000<br>
                                                <strong>Postalisch:</strong> Musterstraße 123, 12345 Musterstadt</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-file-text me-2"></i>Verantwortlich für redaktionelle Inhalte</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>MaxMuster<br>
                                                Musterstraße 123<br>
                                                12345 Musterstadt</p>
                                            <small class="text-muted">Nach § 18 Abs. 2 MStV</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="bi bi-globe me-2"></i>Website-Informationen</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Domain:</strong> YourDomain<br>
                                                <strong>Zweck:</strong> Lernplattform für Fachinformatiker<br>
                                                <strong>Hosting:</strong> YourHoster (Deutschland)<br>
                                                <strong>SSL:</strong> Aktiviert (HTTPS)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-warning mt-4">
                                <h6><i class="bi bi-exclamation-triangle me-2"></i>Haftungsausschluss</h6>
                                <p class="mb-0">Diese Website dient ausschließlich der Aus- und Weiterbildung. Der Betreiber übernimmt keine Gewähr für die Richtigkeit, Vollständigkeit oder Aktualität der bereitgestellten Informationen. Die Nutzung erfolgt auf eigene Gefahr.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>