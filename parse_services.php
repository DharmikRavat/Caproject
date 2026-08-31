<?php

$html = file_get_contents('https://www.cajiteshtelisara.com/');
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

$services = [];
$links = $xpath->query('//a[contains(@href, "services")]');
foreach ($links as $link) {
    $text = trim($link->textContent);
    if (!empty($text)) {
        $services[$text] = $link->getAttribute('href');
    }
}


// Or look at the menu specifically
$menus = $xpath->query('//ul[contains(@class, "sub-menu")]/li/a');
foreach ($menus as $menu) {
    $text = trim($menu->textContent);
    $services[$text] = $menu->getAttribute('href');
}

print_r($services);
