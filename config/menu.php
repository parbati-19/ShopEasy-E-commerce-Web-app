<?php
return [
    'primary_menu' => json_decode(file_get_contents(public_path('menu/menu.json')), true) ['primaryMenu'] ?? [],
    'secondary_menu' => json_decode(file_get_contents(public_path('menu/menu.json')), true) ['secondaryMenu'] ?? [],
    'sidebar_menu' => json_decode(file_get_contents(public_path('menu/menu.json')),true) ['footerMenu'] ?? [],
];
