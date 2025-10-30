<?php
session_start();
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/auth.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $items = load_items();
    $items = array_filter($items, function($item) use ($id) {
        return $item['id'] !== $id;
    });
    save_items($items);
}

header('Location: /wishlist.php');
exit;
