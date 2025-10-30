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
    $max_id = 0;
    foreach ($items as $item) {
        if (isset($item['id']) && $item['id'] > $max_id) {
            $max_id = $item['id'];
        }
    }
    $items[] = [
        'id' => $max_id + 1,
        'who' => htmlspecialchars($who),
        'wish' => htmlspecialchars($wish),
        'added_at' => date('Y-m-d H:i')
    ];
    save_items($items);
}

function autolink($text) {
    $pattern = '/\b((https?|ftp):\/\/|www\.)[^\s\/$.?#].[^\s]*\b/i';
    $callback = function ($matches) {
        $url = $matches[0];
        $display_url = "[Hivatkozás]";
        if (strpos($url, 'www.') === 0) {
            $url = 'http://' . $url;
        }
        return '<a href="' . htmlspecialchars($url) . '" target="_blank" rel="noopener noreferrer" class="text-blue-600/100">' . htmlspecialchars($display_url) . '</a>';
    };
    return preg_replace_callback($pattern, $callback, $text);
}
