<?php
/**
 * Benutzerprofil-Verwaltung
 */

require_once '../config.php';
require_login();

$page_title = 'Mein Profil';

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

// Benutzerdaten laden
$user_stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$user_stmt->execute([$user_id]);
$user = $user_stmt->fetch();

// Verfügbare Avatare definieren (verwende die neuen Avatar-Funktionen)
$available_avatars = get_available_avatars();

// Standardwerte für neue Felder setzen
if (!isset($user['avatar']) || empty($user['avatar'])) {
    $user['avatar'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF-Token prüfen
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'] ?? '';
        
        if ($action === 'update_profile') {
            $username = sanitize_input($_POST['username'] ?? '');
            $email = sanitize_input($_POST['email'] ?? '');
            
            // Validierung
            if (empty($username) || empty($email)) {
                $error = 'Bitte füllen Sie alle Pflichtfelder aus.';
            } elseif (!validate_email($email)) {
                $error = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
            } elseif (strlen($username) < 3 || strlen($username) > 50) {
                $error = 'Der Benutzername muss zwischen 3 und 50 Zeichen lang sein.';
            } else {
                // Prüfen ob E-Mail bereits existiert (außer beim aktuellen Benutzer)
                $email_check = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
                $email_check->execute([$email, $user_id]);
                if ($email_check->fetch()) {
                    $error = 'Diese E-Mail-Adresse wird bereits verwendet.';
                } else {
                    // Profil aktualisieren
                    $update_stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                    if ($update_stmt->execute([$username, $email, $user_id])) {
                        $_SESSION['username'] = $username;
                        $success = 'Profil erfolgreich aktualisiert.';
                        log_user_activity($user_id, 'profile_updated', 'Profile information updated');
                        
                        // Aktualisierte Daten laden
                        $user_stmt->execute([$user_id]);
                        $user = $user_stmt->fetch();
                    } else {
                        $error = 'Fehler beim Aktualisieren des Profils.';
                    }
                }
            }
        } elseif ($action === 'update_extended_profile') {
            // Erweiterte Profil-Felder
            $first_name = sanitize_input($_POST['first_name'] ?? '');
            $last_name = sanitize_input($_POST['last_name'] ?? '');
            $birth_date = sanitize_input($_POST['birth_date'] ?? '');
            $gender = sanitize_input($_POST['gender'] ?? '');
            $location = sanitize_input($_POST['location'] ?? '');
            $bio = sanitize_input($_POST['bio'] ?? '');
            $avatar = (int)sanitize_input($_POST['avatar'] ?? '1');
            
            // Validierung
            $validation_errors = [];
            
            if (strlen($first_name) > 50) {
                $validation_errors[] = 'Der Vorname darf maximal 50 Zeichen lang sein.';
            }
            if (strlen($last_name) > 50) {
                $validation_errors[] = 'Der Nachname darf maximal 50 Zeichen lang sein.';
            }
            if (!empty($birth_date)) {
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth_date)) {
                    $validation_errors[] = 'Bitte geben Sie ein gültiges Geburtsdatum ein.';
                } else {
                    // Prüfen ob maximal 100 Jahre alt
                    $birth_timestamp = strtotime($birth_date);
                    $max_age_timestamp = strtotime('-100 years');
                    $today_timestamp = strtotime('today');
                    
                    if ($birth_timestamp < $max_age_timestamp) {
                        $validation_errors[] = 'Das Geburtsdatum darf nicht mehr als 100 Jahre in der Vergangenheit liegen.';
                    } elseif ($birth_timestamp > $today_timestamp) {
                        $validation_errors[] = 'Das Geburtsdatum darf nicht in der Zukunft liegen.';
                    }
                }
            }
            if (!empty($gender) && !in_array($gender, ['male', 'female', 'other'])) {
                $validation_errors[] = 'Bitte wählen Sie ein gültiges Geschlecht aus.';
            }
            if (strlen($location) > 100) {
                $validation_errors[] = 'Der Standort darf maximal 100 Zeichen lang sein.';
            }
            if (strlen($bio) > 500) {
                $validation_errors[] = 'Die Biografie darf maximal 500 Zeichen lang sein.';
            }
            // Avatar-Validierung: Prüfe ob Avatar-ID in verfügbaren Avataren existiert
            $valid_avatar_ids = array_column($available_avatars, 'id');
            if (!in_array($avatar, $valid_avatar_ids)) {
                $validation_errors[] = 'Bitte wählen Sie einen gültigen Avatar aus.';
            }
            
            if (empty($validation_errors)) {
                // Profil aktualisieren
                $update_stmt = $pdo->prepare("
                    UPDATE users 
                    SET first_name = ?, last_name = ?, birth_date = ?, gender = ?, 
                        location = ?, bio = ?, avatar = ?
                    WHERE id = ?
                ");
                
                $birth_date_value = !empty($birth_date) ? $birth_date : null;
                $gender_value = !empty($gender) ? $gender : null;
                
                if ($update_stmt->execute([
                    $first_name, $last_name, $birth_date_value, $gender_value,
                    $location, $bio, $avatar, $user_id
                ])) {
                    $success = 'Erweiterte Profil-Informationen erfolgreich aktualisiert.';
                    log_user_activity($user_id, 'extended_profile_updated', 'Extended profile information updated');
                    
                    // Aktualisierte Daten laden
                    $user_stmt->execute([$user_id]);
                    $user = $user_stmt->fetch();
                } else {
                    $error = 'Fehler beim Aktualisieren der Profil-Informationen.';
                }
            } else {
                $error = implode('<br>', $validation_errors);
            }
        } elseif ($action === 'change_password') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            // Validierung
            if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $error = 'Bitte füllen Sie alle Passwort-Felder aus.';
            } elseif (!password_verify($current_password, $user['password_hash'])) {
                $error = 'Das aktuelle Passwort ist falsch.';
            } elseif (!validate_password($new_password)) {
                $error = 'Das neue Passwort muss mindestens 8 Zeichen lang sein und Groß- und Kleinbuchstaben sowie Zahlen enthalten.';
            } elseif ($new_password !== $confirm_password) {
                $error = 'Die neuen Passwörter stimmen nicht überein.';
            } else {
                // Passwort aktualisieren
                $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
                if ($update_stmt->execute([$new_hash, $user_id])) {
                    $success = 'Passwort erfolgreich geändert.';
                    log_user_activity($user_id, 'password_changed', 'Password changed successfully');
                } else {
                    $error = 'Fehler beim Ändern des Passworts.';
                }
            }
        } elseif ($action === 'disable_2fa') {
            $current_password = $_POST['current_password'] ?? '';
            $verification_code = $_POST['verification_code'] ?? '';
            
            // Validierung
            if (empty($current_password) || empty($verification_code)) {
                $error = 'Bitte füllen Sie alle Felder aus.';
            } elseif (!password_verify($current_password, $user['password_hash'])) {
                $error = 'Das aktuelle Passwort ist falsch.';
            } elseif (!verify_2fa_code($user['two_factor_secret'], $verification_code)) {
                $error = 'Ungültiger 2FA-Code. Bitte versuchen Sie es erneut.';
            } else {
                // 2FA deaktivieren
                $update_stmt = $pdo->prepare("UPDATE users SET two_factor_secret = NULL, two_factor_enabled = 0, two_factor_backup_codes = NULL WHERE id = ?");
                if ($update_stmt->execute([$user_id])) {
                    $success = '2FA erfolgreich deaktiviert.';
                    log_user_activity($user_id, '2fa_disabled', '2FA disabled successfully');
                    
                    // Aktualisierte Daten laden
                    $user_stmt->execute([$user_id]);
                    $user = $user_stmt->fetch();
                } else {
                    $error = 'Fehler beim Deaktivieren der 2FA.';
                }
            }
        }
    }
}

include '../includes/header.php';
?>
<div class="layout-container with-sidebar">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <i class="bi bi-person me-2"></i>
                        Mein Profil
                    </h1>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Belohnungspunkte</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $reward_data = get_user_reward_points($user_id);
                                    ?>
                                    <div class="row text-center">
                                        <div class="col-md-4 mb-3">
                                            <div class="card bg-warning text-dark">
                                                <div class="card-body">
                                                    <h3 class="mb-1"><?= number_format($reward_data['reward_points']) ?></h3>
                                                    <p class="mb-0">IT-Coins</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card bg-success text-white">
                                                <div class="card-body">
                                                    <h3 class="mb-1"><?= $reward_data['total_quizzes_passed'] ?></h3>
                                                    <p class="mb-0">IT-Coin-Quizzes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card bg-info text-white">
                                                <div class="card-body">
                                                    <h3 class="mb-1"><?= $reward_data['total_rewards'] ?></h3>
                                                    <p class="mb-0">Gesamte Belohnungen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info mt-3 mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <strong>Wie funktioniert das IT-Coin-System?</strong><br>
                                        Du erhältst IT-Coins für erfolgreich abgeschlossene Quizzes:<br>
                                        • 60-69% richtig: 1 Punkt<br>
                                        • 70-79% richtig: 3 Punkte<br>
                                        • 80-89% richtig: 5 Punkte<br>
                                        • 90-99% richtig: 8 Punkte<br>
                                        • 100% richtig: 10 Punkte
                                    </div>
                                    <?php
                                } catch (Exception $e) {
                                    echo '<div class="alert alert-danger mb-0">';
                                    echo '<i class="bi bi-exclamation-triangle me-2"></i>';
                                    echo 'Fehler beim Laden der Belohnungspunkte.';
                                    echo '</div>';
                                    error_log("Reward points error: " . $e->getMessage());
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-0">
                            <!-- Grundlegende Profil-Informationen -->
                            <div class="col-lg-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Grundlegende Informationen</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate>
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="update_profile">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Benutzername</label>
                                                <input type="text" class="form-control-plaintext fw-bold" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" readonly tabindex="-1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-Mail-Adresse</label>
                                                <input type="email" class="form-control-plaintext" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly tabindex="-1">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rolle</label>
                                                <?php
                                                    $role_map = [
                                                        'admin' => 'Administrator',
                                                        'moderator' => 'Moderator',
                                                        'student' => 'Auszubildender'
                                                    ];
                                                    $role_label = isset($role_map[$user['role']]) ? $role_map[$user['role']] : htmlspecialchars($user['role']);
                                                ?>
                                                <input type="text" class="form-control-plaintext" value="<?= $role_label ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Registriert am</label>
                                                <input type="text" class="form-control-plaintext" value="<?= format_german_datetime($user['registration_date']) ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Letzter Login</label>
                                                <input type="text" class="form-control-plaintext" value="<?= $user['last_login'] ? format_german_datetime($user['last_login']) : 'Noch nie' ?>" readonly>
                                            </div>
                                            <div class="alert alert-info d-flex align-items-center"><i class="bi bi-info-circle me-2"></i>Benutzername und E-Mail-Adresse können nach der Registrierung nicht mehr geändert werden.</div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Erweiterte Profil-Informationen -->
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Erweiterte Informationen</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate>
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="update_extended_profile">
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="first_name" class="form-label">Vorname</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                                           value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" 
                                                           maxlength="50">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="last_name" class="form-label">Nachname</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                                           value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" 
                                                           maxlength="50">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="birth_date" class="form-label">
                                                        <i class="bi bi-calendar-event me-1"></i>Geburtsdatum
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-calendar3"></i>
                                                        </span>
                                                        <input type="date" class="form-control" id="birth_date" name="birth_date" 
                                                               value="<?= htmlspecialchars($user['birth_date'] ?? '') ?>"
                                                               placeholder="TT.MM.JJJJ" min="" max="">
                                                    </div>
                                                    <div class="form-text">
                                                        <i class="bi bi-info-circle me-1"></i>Optional - Maximal 100 Jahre alt
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="gender" class="form-label">
                                                        <i class="bi bi-person me-1"></i>Geschlecht
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-gender-ambiguous"></i>
                                                        </span>
                                                        <select class="form-select" id="gender" name="gender">
                                                            <option value="">Bitte wählen...</option>
                                                            <option value="male" <?= ($user['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Männlich</option>
                                                            <option value="female" <?= ($user['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Weiblich</option>
                                                            <option value="other" <?= ($user['gender'] ?? '') === 'other' ? 'selected' : '' ?>>Divers</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-text">
                                                        <i class="bi bi-info-circle me-1"></i>Optional - Nur für statistische Zwecke
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="location" class="form-label">
                                                    <i class="bi bi-geo-alt me-1"></i>Standort
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-geo-alt-fill"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="location" name="location" 
                                                           value="<?= htmlspecialchars($user['location'] ?? '') ?>" 
                                                           placeholder="z.B. Berlin, Deutschland" maxlength="100">
                                                </div>
                                                <div class="form-text">
                                                    <i class="bi bi-info-circle me-1"></i>Optional - Stadt und Land
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="bio" class="form-label">
                                                    <i class="bi bi-person-lines-fill me-1"></i>Biografie
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-chat-text"></i>
                                                    </span>
                                                    <textarea class="form-control" id="bio" name="bio" rows="3" 
                                                              maxlength="500" placeholder="Erzählen Sie etwas über sich..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                                                </div>
                                                <div class="form-text">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    <span id="bio-counter">0</span>/500 Zeichen - Optional
                                                </div>
                                            </div>
                                            
                                            
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-save me-2"></i>Erweiterte Informationen speichern
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Avatar-Auswahl -->
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">
                                            <i class="bi bi-person-square me-2"></i>Avatar auswählen
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate>
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="update_extended_profile">
                                            
                                            <div class="row">
                                                <div class="col-lg-8 mb-4">
                                                    <label class="form-label fw-bold mb-3">
                                                        <i class="bi bi-image me-1"></i>Wähle deinen Avatar
                                                    </label>
                                                    <div class="avatar-grid">
                                                        <?php 
                                                        $current_avatar = (int)($user['avatar'] ?? 1);
                                                        foreach ($available_avatars as $avatar): 
                                                            $is_selected = $current_avatar == $avatar['id'];
                                                        ?>
                                                            <label class="avatar-option <?= $is_selected ? 'selected' : '' ?>" 
                                                                   data-avatar-id="<?= $avatar['id'] ?>"
                                                                   data-avatar-name="<?= htmlspecialchars($avatar['name']) ?>">
                                                                <input type="radio" name="avatar" value="<?= $avatar['id'] ?>" 
                                                                       <?= $is_selected ? 'checked' : '' ?> 
                                                                       class="avatar-radio" style="display: none;">
                                                                <div class="avatar-thumbnail">
                                                                    <img src="<?= $avatar['path'] ?>" 
                                                                         alt="<?= htmlspecialchars($avatar['name']) ?>"
                                                                         class="avatar-img-thumb"
                                                                         loading="lazy"
                                                                         onerror="this.onerror=null; this.src='/assets/img/avatars/1.png';">
                                                                    <?php if ($is_selected): ?>
                                                                        <div class="avatar-check">
                                                                            <i class="bi bi-check-circle-fill"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <small class="avatar-label"><?= htmlspecialchars($avatar['name']) ?></small>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-4">
                                                    <div class="card bg-light">
                                                        <div class="card-body text-center">
                                                            <h6 class="mb-3">
                                                                <i class="bi bi-eye me-1"></i>Vorschau
                                                            </h6>
                                                            <div class="avatar-preview-container mb-3">
                                                                <?= render_simple_avatar($_SESSION['user_id'], $current_avatar, 'xxl') ?>
                                                            </div>
                                                            <p class="mb-0">
                                                                <strong id="avatar-name"><?php 
                                                                    $avatar_index = max(0, $current_avatar - 1);
                                                                    echo $available_avatars[$avatar_index]['name'] ?? 'Avatar 1';
                                                                ?></strong>
                                                            </p>
                                                            <small class="text-muted">Dein aktueller Avatar</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr class="my-4">
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="text-muted">
                                                    <i class="bi bi-info-circle me-1"></i>
                                                    Klicke auf einen Avatar, um ihn auszuwählen
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="bi bi-save me-2"></i>Avatar speichern
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <!-- Passwort ändern & 2FA -->
                        <div class="row g-4">
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0"><i class="bi bi-lock me-2"></i>Passwort ändern</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate>
                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                            <input type="hidden" name="action" value="change_password">

                                            <div class="mb-3">
                                                <label for="current_password" class="form-label">Aktuelles Passwort</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                                    <button class="btn btn-outline-secondary btn-toggle-password" type="button">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Bitte geben Sie Ihr aktuelles Passwort ein.
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">Neues Passwort</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                    <button class="btn btn-outline-secondary btn-toggle-password" type="button">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">
                                                    Mindestens 8 Zeichen, Groß- und Kleinbuchstaben, Zahlen
                                                </div>
                                                <div class="invalid-feedback">
                                                    Bitte geben Sie ein gültiges neues Passwort ein.
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="confirm_password" class="form-label">Neues Passwort bestätigen</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                                    <button class="btn btn-outline-secondary btn-toggle-password" type="button">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Bitte bestätigen Sie Ihr neues Passwort.
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-key me-2"></i>Passwort ändern
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Zwei-Faktor-Authentifizierung (2FA)</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($user['two_factor_enabled']): ?>
                                            <div class="alert alert-success d-flex align-items-center">
                                                <i class="bi bi-shield-check me-2"></i>
                                                <div>
                                                    <strong>2FA ist aktiviert</strong><br>
                                                    <small>Ihr Account ist durch Zwei-Faktor-Authentifizierung geschützt.</small>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#disable2faModal">
                                                <i class="bi bi-shield-x me-2"></i>2FA deaktivieren
                                            </button>
                                        <?php else: ?>
                                            <div class="alert alert-warning d-flex align-items-center">
                                                <i class="bi bi-shield-exclamation me-2"></i>
                                                <div>
                                                    <strong>2FA ist nicht aktiviert</strong><br>
                                                    <small>Erhöhen Sie die Sicherheit Ihres Accounts durch Zwei-Faktor-Authentifizierung.</small>
                                                </div>
                                            </div>
                                            <a href="/auth/2fa_setup.php" class="btn btn-primary">
                                                <i class="bi bi-shield-lock me-2"></i>2FA einrichten
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                <!-- Datenschutz & Login -->
                <div class="row mt-4 g-4">
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="bi bi-shield-check me-2"></i>Datenschutz-Einstellungen</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="privacy_consent" <?= $user['privacy_consent'] ? 'checked' : '' ?> disabled>
                                            <label class="form-check-label" for="privacy_consent">
                                                Datenschutzerklärung akzeptiert
                                            </label>
                                        </div>
                                        <small class="text-muted">Akzeptiert am: <?= $user['privacy_consent'] ? format_german_datetime($user['registration_date']) : 'Nicht akzeptiert' ?></small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="newsletter_consent" <?= $user['newsletter_consent'] ? 'checked' : '' ?> disabled>
                                            <label class="form-check-label" for="newsletter_consent">
                                                Newsletter abonniert
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <h6><i class="bi bi-gear me-2"></i>Datenverwaltung</h6>
                                        <p class="text-muted mb-3">
                                            Verwalten Sie Ihre personenbezogenen Daten gemäß DSGVO. 
                                            Sie können Ihre Daten exportieren oder Ihr Konto löschen.
                                        </p>
                                        <a href="/users/gdpr_data_management.php" class="btn btn-outline-primary">
                                            <i class="bi bi-gear me-2"></i>Zur Datenverwaltung
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <h6><i class="bi bi-clock-history me-2"></i>Aktivitätsprotokoll</h6>
                                        <p class="text-muted mb-3">
                                            Sehen Sie alle Ihre Aktivitäten auf der Plattform ein. 
                                            Verfolgen Sie Ihre Quiz-Aktivitäten, Profiländerungen und mehr.
                                        </p>
                                        <a href="/users/activity.php" class="btn btn-outline-info">
                                            <i class="bi bi-clock-history me-2"></i>Zu meinen Aktivitäten
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Login-Historie</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                try {
                                    $login_stmt = $pdo->prepare("
                                        SELECT login_at, ip_address, user_agent 
                                        FROM user_logins 
                                        WHERE user_id = ? 
                                        ORDER BY login_at DESC 
                                        LIMIT 10
                                    ");
                                    $login_stmt->execute([$user_id]);
                                    $login_history = $login_stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if (!empty($login_history)) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-sm table-striped mb-0 text-dark">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th><i class="bi bi-calendar me-1"></i>Datum & Zeit</th>';
                                        echo '<th><i class="bi bi-geo-alt me-1"></i>IP-Adresse</th>';
                                        echo '<th><i class="bi bi-browser-chrome me-1"></i>Browser</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        
                                        foreach ($login_history as $login) {
                                            echo '<tr>';
                                            echo '<td>' . format_german_datetime($login['login_at']) . '</td>';
                                            echo '<td><code>' . htmlspecialchars($login['ip_address'] ?? 'Nicht verfügbar') . '</code></td>';
                                            
                                            $browser = $login['user_agent'] ?? 'Nicht verfügbar';
                                            if (strlen($browser) > 50) {
                                                $browser = substr($browser, 0, 47) . '...';
                                            }
                                            echo '<td><small>' . htmlspecialchars($browser) . '</small></td>';
                                            echo '</tr>';
                                        }
                                        
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                        
                                        echo '<div class="alert alert-info mt-3 mb-0">';
                                        echo '<i class="bi bi-info-circle me-2"></i>';
                                        echo '<strong>Hinweis:</strong> Es werden die letzten 10 Login-Sessions angezeigt. ';
                                        echo 'Die vollständige Login-Historie können Sie in der <a href="gdpr_data_management.php">Datenverwaltung</a> einsehen.';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="alert alert-warning">';
                                        echo '<i class="bi bi-exclamation-triangle me-2"></i>';
                                        echo 'Keine Login-Daten verfügbar. Diese werden ab dem nächsten Login gespeichert.';
                                        echo '</div>';
                                    }
                                } catch (PDOException $e) {
                                    echo '<div class="alert alert-danger">';
                                    echo '<i class="bi bi-exclamation-triangle me-2"></i>';
                                    echo 'Fehler beim Laden der Login-Historie.';
                                    echo '</div>';
                                    error_log("Login history error: " . $e->getMessage());
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- 2FA Deaktivierungs-Modal -->
<div class="modal fade" id="disable2faModal" tabindex="-1" aria-labelledby="disable2faModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disable2faModalLabel">
                    <i class="bi bi-shield-x me-2"></i>2FA deaktivieren
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="action" value="disable_2fa">
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Achtung:</strong> Durch das Deaktivieren der 2FA wird die Sicherheit Ihres Accounts reduziert.
                    </div>
                    
                    <div class="mb-3">
                        <label for="modal_current_password" class="form-label">Aktuelles Passwort</label>
                        <input type="password" class="form-control" id="modal_current_password" name="current_password" required>
                        <div class="invalid-feedback">
                            Bitte geben Sie Ihr aktuelles Passwort ein.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modal_verification_code" class="form-label">2FA-Code</label>
                        <input type="text" class="form-control" id="modal_verification_code" name="verification_code" 
                               maxlength="6" pattern="[0-9]{6}" placeholder="123456" required>
                        <div class="form-text">
                            Geben Sie den 6-stelligen Code aus Ihrer Authenticator-App ein.
                        </div>
                        <div class="invalid-feedback">
                            Bitte geben Sie einen gültigen 6-stelligen Code ein.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-shield-x me-2"></i>2FA deaktivieren
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<style>
/* Avatar-Grid Styling */
.avatar-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 1rem;
    padding: 1rem 0;
}

.avatar-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    padding: 0.75rem;
    border: 2px solid #dee2e6;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    background: #fff;
    text-align: center;
}

.avatar-option:hover {
    border-color: #0d6efd;
    background: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.avatar-option.selected {
    border-color: #0d6efd;
    background: #e7f3ff;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
}

.avatar-thumbnail {
    position: relative;
    width: 80px;
    height: 80px;
    margin-bottom: 0.5rem;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.avatar-option.selected .avatar-thumbnail {
    border-color: #0d6efd;
}

.avatar-img-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-check {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.avatar-label {
    font-size: 0.75rem;
    color: #6c757d;
    font-weight: 500;
}

.avatar-option.selected .avatar-label {
    color: #0d6efd;
    font-weight: 600;
}

/* Card-Verschönerungen */
.card {
    border: none;
    border-radius: 0.75rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.card-header {
    border-bottom: 2px solid #f0f0f0;
    border-radius: 0.75rem 0.75rem 0 0 !important;
    font-weight: 600;
}

.card-header.bg-primary {
    border-bottom: none;
}

/* Form-Verschönerungen */
.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.input-group-text {
    border-radius: 0.5rem 0 0 0.5rem;
    background: #f8f9fa;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.input-group .form-control:focus {
    border-left: 1px solid #0d6efd;
}

/* Button-Verschönerungen */
.btn {
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Responsive Anpassungen */
@media (max-width: 768px) {
    .avatar-grid {
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 0.75rem;
    }
    
    .avatar-thumbnail {
        width: 60px;
        height: 60px;
    }
}
</style>

<script>
// Nur Zahlen erlauben für 2FA-Code
document.getElementById('modal_verification_code')?.addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Biografie-Zeichenzähler
document.getElementById('bio')?.addEventListener('input', function(e) {
    const counter = document.getElementById('bio-counter');
    if (counter) {
        counter.textContent = this.value.length;
        if (this.value.length > 450) {
            counter.classList.add('text-warning');
        } else {
            counter.classList.remove('text-warning');
        }
        if (this.value.length >= 500) {
            counter.classList.add('text-danger');
        } else {
            counter.classList.remove('text-danger');
        }
    }
});


// Datums-Validierung (max. 100 Jahre)
document.addEventListener('DOMContentLoaded', function() {
    const birthDateField = document.getElementById('birth_date');
    if (birthDateField) {
        const today = new Date();
        const hundredYearsAgo = new Date();
        hundredYearsAgo.setFullYear(today.getFullYear() - 100);
        
        birthDateField.setAttribute('min', hundredYearsAgo.toISOString().split('T')[0]);
        birthDateField.setAttribute('max', today.toISOString().split('T')[0]);
    }
    
    // Avatar-Auswahl mit visueller Rückmeldung
    const avatarOptions = document.querySelectorAll('.avatar-option');
    const avatarPreview = document.querySelector('.avatar-preview-container .avatar-container img');
    const avatarName = document.getElementById('avatar-name');
    
    avatarOptions.forEach(function(option) {
        const radio = option.querySelector('.avatar-radio');
        const thumbnail = option.querySelector('.avatar-thumbnail');
        
        // Klick auf Avatar-Option
        option.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                // Radio-Button aktivieren
                radio.checked = true;
                
                // Alle Optionen deselektieren
                avatarOptions.forEach(function(opt) {
                    opt.classList.remove('selected');
                    const check = opt.querySelector('.avatar-check');
                    if (check) check.remove();
                });
                
                // Aktuelle Option selektieren
                option.classList.add('selected');
                
                // Check-Icon hinzufügen
                if (!option.querySelector('.avatar-check')) {
                    const checkDiv = document.createElement('div');
                    checkDiv.className = 'avatar-check';
                    checkDiv.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
                    thumbnail.appendChild(checkDiv);
                }
                
                // Vorschau aktualisieren
                if (avatarPreview && avatarName) {
                    const avatarId = option.dataset.avatarId;
                    const avatarNameText = option.dataset.avatarName;
                    avatarPreview.src = '/assets/img/avatars/' + avatarId + '.png';
                    avatarName.textContent = avatarNameText;
                }
            }
        });
        
        // Radio-Button-Änderung
        radio.addEventListener('change', function() {
            if (this.checked) {
                // Alle Optionen deselektieren
                avatarOptions.forEach(function(opt) {
                    opt.classList.remove('selected');
                    const check = opt.querySelector('.avatar-check');
                    if (check) check.remove();
                });
                
                // Aktuelle Option selektieren
                option.classList.add('selected');
                
                // Check-Icon hinzufügen
                if (!option.querySelector('.avatar-check')) {
                    const checkDiv = document.createElement('div');
                    checkDiv.className = 'avatar-check';
                    checkDiv.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
                    thumbnail.appendChild(checkDiv);
                }
                
                // Vorschau aktualisieren
                if (avatarPreview && avatarName) {
                    const avatarId = option.dataset.avatarId;
                    const avatarNameText = option.dataset.avatarName;
                    avatarPreview.src = '/assets/img/avatars/' + avatarId + '.png';
                    avatarName.textContent = avatarNameText;
                }
            }
        });
    });
    
    // Initiale Biografie-Zeichenzahl setzen
    const bioField = document.getElementById('bio');
    const counter = document.getElementById('bio-counter');
    if (bioField && counter) {
        counter.textContent = bioField.value.length;
    }
});

// Form-Validierung
(function() {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();
</script>

<?php include '../includes/footer.php'; ?>