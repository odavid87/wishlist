<?php
session_start();
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';

define('AUTH_COOKIE_NAME', 'wishlist_auth');

$authenticated = false;

if (isset($_COOKIE[AUTH_COOKIE_NAME]) && $_COOKIE[AUTH_COOKIE_NAME] === APP_PASSWORD) {
    $authenticated = true;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] === APP_PASSWORD) {
        setcookie(AUTH_COOKIE_NAME, APP_PASSWORD, time() + (86400 * 90), "/"); // 90 days
        $authenticated = true;
        header('Location: /wishlist.php');
        exit;
    } else {
        $error_message = "Hibás jelszó.";
    }
}

if (!$authenticated) {
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Családi Wishlist 🎁</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50 m-0 p-4 md:p-8">
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4">
    <a href="/" class="block text-center mb-8 text-gray-500 no-underline hover:text-gray-900">Vissza a főoldalra</a>
    <h1 class="text-center text-4xl font-bold mb-8 text-red-700">🎄 Családi Kívánságlista</h1>

    <?php if (isset($error_message)): ?>
        <p class="text-center text-red-500 mb-4"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post" class="flex flex-col gap-2 mb-8">
        <input type="password" name="password" placeholder="Jelszó" required class="p-2 text-base rounded-lg border border-gray-300">
        <button type="submit" class="bg-red-700 text-white cursor-pointer transition duration-200 hover:bg-red-800 p-2 text-base rounded-lg">Belépés</button>
    </form>
</div>
</body>
</html>
<?php
    exit;
}

$items = array_reverse(load_items());
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Családi Kívánságlista 🎁</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50 m-0 p-4 md:p-8">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4">
        <a href="/" class="block text-center mb-8 text-gray-500 no-underline hover:text-gray-900">Vissza a főoldalra</a>
        <h1 class="text-center text-2xl font-bold mb-8 text-red-700">🎄 Családi Kívánságlista</h1>

        <form action="add.php" method="post" class="flex flex-col gap-2 mb-8">
            <input type="text" name="who" placeholder="Ki kívánja?" required class="p-2 text-base rounded-lg border border-gray-300">
            <input type="text" name="wish" placeholder="Mit szeretnél?" required class="p-2 text-base rounded-lg border border-gray-300">
            <button type="submit" class="bg-red-700 text-white cursor-pointer transition duration-200 hover:bg-red-800 p-2 text-base rounded-lg">➕ Hozzáadás</button>
        </form>
    </div>
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4 m-2">
        <h2 class="text-center text-2xl font-bold mb-4 text-gray-600">Kívánságok</h2>
        <ul class="list-none p-0 m-0">
            <?php if (empty($items)): ?>
                <li class="text-center text-gray-500">Még nincs kívánság 🌟</li>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <li class="bg-gray-50 m-1 p-2 rounded-lg flex justify-between items-center flex-wrap">
                        <div class="flex flex-col">
                            <strong class="text-base"><?= $item['who'] ?></strong>
                            <span class="text-sm"><?= $item['wish'] ?></span>
                        </div>
                        <small class="text-gray-500 text-xs"><?= $item['added_at'] ?></small>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
