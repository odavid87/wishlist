<?php
define('AUTH_COOKIE_NAME', 'wishlist_auth');

$authenticated = false;

if (isset($_COOKIE[AUTH_COOKIE_NAME]) && $_COOKIE[AUTH_COOKIE_NAME] === APP_PASSWORD) {
    $authenticated = true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === APP_PASSWORD) {
        setcookie(AUTH_COOKIE_NAME, APP_PASSWORD, time() + (86400 * 90), "/"); // 90 days
        $authenticated = true;
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        $error_message = "Hibás jelszó.";
    }
}

if (!$authenticated) {
    require_once __DIR__ . '/../unauthenticated.php';
    exit;
}