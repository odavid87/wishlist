<?php
session_start();
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';
require __DIR__ . '/includes/auth.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$items = load_items();
$item_to_edit = null;

foreach ($items as $item) {
    if ($item['id'] === $id) {
        $item_to_edit = $item;
        break;
    }
}

if (!$item_to_edit) {
    header('Location: /wishlist.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $who = trim($_POST['who']);
    $wish = trim($_POST['wish']);

    if ($who && $wish) {
        foreach ($items as &$item) {
            if ($item['id'] === $id) {
                $item['who'] = htmlspecialchars($who);
                $item['wish'] = htmlspecialchars($wish);
                break;
            }
        }
        save_items($items);
        header('Location: /wishlist.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Kívánság szerkesztése</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50 m-0 p-4 md:p-8">
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4">
    <h1 class="text-center text-2xl font-bold mb-4 text-red-700">Kívánság szerkesztése</h1>
    <form method="post" class="flex flex-col gap-2 mb-2">
        <input type="text" name="who" value="<?= $item_to_edit['who'] ?>" required class="p-2 text-base rounded-lg border border-gray-300">
        <textarea rows="10" id="wish" name="wish" placeholder="Mit szeretnél?" required class="p-2 text-base rounded-lg border border-gray-300 text-sm"><?= $item_to_edit['wish'] ?></textarea>

        <button type="submit" class="bg-red-700 text-white cursor-pointer transition duration-200 hover:bg-red-800 p-2 text-base rounded-lg">Mentés</button>
    </form>
    <a href="/wishlist.php" class="block text-center mt-4 text-gray-500 no-underline hover:text-gray-900">Mégse</a>
</div>
</body>
</html>
