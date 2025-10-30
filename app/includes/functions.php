<?php

function load_items() {
    if (!file_exists(DATA_FILE)) {
        file_put_contents(DATA_FILE, json_encode([]));
    }
    $data = file_get_contents(DATA_FILE);
    return json_decode($data, true) ?: [];
}

function save_items(array $items) {
    file_put_contents(DATA_FILE, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function add_item($who, $wish) {
    $items = load_items();
    $items[] = [
        'who' => htmlspecialchars($who),
        'wish' => htmlspecialchars($wish),
        'added_at' => date('Y-m-d H:i')
    ];
    save_items($items);
}
