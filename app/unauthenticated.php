<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Huncutkák kívánságai 🎁</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50 m-0 p-4 md:p-8">
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-4">
    <a href="/" class="block text-center mb-2 text-gray-500 no-underline hover:text-gray-900">Vissza a főoldalra</a>
    <h1 class="text-center text-2xl font-bold mb-4 text-red-700">🎁 Huncutkák kívánságai</h1>

    <?php if (isset($error_message)): ?>
        <p class="text-center text-red-500 mb-2"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="post" class="flex flex-col gap-2 mb-2">
        <input type="password" name="password" placeholder="Jelszó" required class="p-2 text-base rounded-lg border border-gray-300">
        <button type="submit" class="bg-red-700 text-white cursor-pointer transition duration-200 hover:bg-red-800 p-2 text-base rounded-lg">Belépés</button>
    </form>
</div>
</body>
</html><?php
