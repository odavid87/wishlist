<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/functions.php';
$items = array_reverse(load_items());
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <title>Családi Wishlist 🎁</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="container">
    <h1>🎄 Családi Wishlist</h1>

    <form action="add.php" method="post" class="wish-form">
        <input type="password" name="password" placeholder="Jelszó" required>
        <input type="text" name="who" placeholder="Ki kívánja?" required>
        <input type="text" name="wish" placeholder="Mit szeretnél?" required>
        <button type="submit">➕ Hozzáadás</button>
    </form>

    <h2>Lista</h2>
    <ul class="wishlist">
        <?php if (empty($items)): ?>
            <li class="empty">Még nincs kívánság 🌟</li>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
                <li>
                    <div class="wish">
                        <strong><?= $item['who'] ?></strong>
                        <span><?= $item['wish'] ?></span>
                    </div>
                    <small><?= $item['added_at'] ?></small>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
