<?php
session_start();
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/auth.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$items = load_items();
$item_to_display = null;

foreach ($items as $item) {
    if ($item['id'] === $id) {
        $item_to_display = $item;
        break;
    }
}

if (!$item_to_display) {
    header('Location: /wishlist.php');
    exit;
}

$pageTitle = htmlspecialchars($item_to_display['who']) . " kívánsága";
$pageDescription = "Nézd meg " . htmlspecialchars($item_to_display['who']) . " kívánságát: " . htmlspecialchars($item_to_display['wish']);
$pageUrl = "https://mamahuncutkai.hu/wish.php?id=" . $id;
$ogImage = "https://mamahuncutkai.hu/assets/favicon/android-chrome-512x512.png";

?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $pageDescription ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $pageUrl ?>">
    <meta property="og:image" content="<?= $ogImage ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50 m-0 p-4 md:p-8">
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4">
    <img src="/assets/favicon/android-chrome-512x512.png" alt="Mama huncutkái" class="mb-4">
    <h1 class="text-center text-2xl font-bold mb-4 text-red-700">Kívánság részletei</h1>
    <div class="bg-gray-50 m-1 my-2 p-2 rounded-lg">
        <div class="flex flex-col gap-2">
            <strong class="text-base">⭐<?= htmlspecialchars($item_to_display['who']) ?>⭐ kívánsága</strong>
            <span class="text-sm"><?= nl2br(autolink(htmlspecialchars($item_to_display['wish']))) ?></span>
            <span class="text-xs text-gray-500">Hozzáadva: <?= htmlspecialchars($item_to_display['added_at']) ?></span>
        </div>
        <div class="flex gap-4 justify-end mt-2">
            <a href="edit.php?id=<?= $item_to_display['id'] ?>" class="text-gray-400 hover:text-blue-500"><i class="fas fa-pencil-alt"></i></a>
            <a href="delete.php?id=<?= $item_to_display['id'] ?>" class="text-gray-400 hover:text-red-500" onclick="return confirm('Biztosan törlöd?');"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
    <a href="/wishlist.php" class="block text-center mt-4 text-gray-500 no-underline hover:text-gray-900">Vissza a kívánságlistára</a>
</div>
</body>
</html>