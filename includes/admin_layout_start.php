<?php
/**
 * Admin Layout Start - Konsistente Layout-Struktur für Admin-Seiten
 * Verwendung: include '../includes/admin_layout_start.php'; nach dem Header
 */

// Sicherstellen, dass nur Admins Zugriff haben
if (!function_exists('is_admin') || !is_admin()) {
    header('Location: /auth/login.php');
    exit();
}
?>

<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">