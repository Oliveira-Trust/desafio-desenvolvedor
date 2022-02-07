<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Home',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],
         [
            'title' => 'Configurações',
            'root' => true,
            'icon' => 'media/svg/icons/Tools/Tools.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/configurations',
            'new-tab' => false,
        ],
    ]

];
