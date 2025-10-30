<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['password'] !== APP_PASSWORD) {
        http_response_code(403);
        echo "Hibás jelszó.";
        exit;
    }

    $who = trim($_POST['who']);
    $wish = trim($_POST['wish']);

    if ($who && $wish) {
        add_item($who, $wish);
    }
}
header('Location: /wishlist.php');
exit;
