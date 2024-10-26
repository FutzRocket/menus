<?php

use FutzRocket\Menus;
use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Manager;

// Get an instance of the Menu Manager
$menus = new Manager();
// Create a new menu
$menus->createMenu('primary');
// Get the Menu instance
$primary_menu = $menus->menu('primary');
// Set the menu data
$primary_menu->setData(
    [
        'tag' => 'ul',
        'atts' => [
            'class' => 'menu nav',
            'id' => 'primary-menu',
        ],
        'wrapperTag' => 'div',
        'wrapperAtts' => [
            'class' => 'primary-menu-wrapper'
        ],
    ]
);
// Add menu items
$home = new MenuItem(
    [
        'title' => 'Home',
        'url' => 'http://localhost/menus/',
        'tag' => 'a',
        'atts' => [
            'class' => 'nav-link'
        ],
        'wrapperTag' => 'li',
        'wrapperAtts' => [
            'class' => 'nav-item'
        ],
    ]
);
$primary_menu->addItem($home);

$about = new MenuItem(
    [
        'title' => 'About',
        'url' => 'http://localhost/menus/#',
        'tag' => 'a',
        'atts' => [
            'class' => 'nav-link'
        ],
        'wrapperTag' => 'li',
        'wrapperAtts' => [
            'class' => 'nav-item'
        ],
    ]
);
$primary_menu->addItem($about);

$item = new MenuItem(
    [
        'title' => 'Contact',
        'url' => 'http://localhost/menus/#',
        'tag' => 'a',
        'atts' => [
            'class' => 'nav-link'
        ],
        'wrapperTag' => 'li',
        'wrapperAtts' => [
            'class' => 'nav-item'
        ]
    ]
);
$primary_menu->addItem($item);
// Create a collection
$primary_menu->createCollection('services', 'Services');
// Get the collection instance
$services = $primary_menu->collection('services');
// Set the collection data
$data = [
    'tag' => 'ul',
    'atts' => [
        'class' => 'dropdown-menu'
    ],
    'titleTag' => 'a',
    'titleAtts' => [
        'class' => 'nav-link dropdown-toggle',
        'href' => 'http://localhost/menus/#',
        'role' => 'button',
        'data-bs-toggle' => 'dropdown',
        'aria-expanded' => 'false'
    ],
    'wrapperTag' => 'li',
    'wrapperAtts' => [
        'class' => 'nav-item dropdown'
    ],
];
$services->setData($data);
//
$items = [
    new MenuItem(
        [
            'title' => 'Web Development',
            'url' => 'http://localhost/menus/#',
            'tag' => 'a',
            'atts' => [
                'class' => 'dropdown-item'
            ],
            'wrapperTag' => 'li',
            'wrapperAtts' => [
                'class' => 'nav-item'
            ]
        ]
    ),
    new MenuItem(
        [
            'title' => 'Mobile Development',
            'url' => 'http://localhost/menus/#',
            'tag' => 'a',
            'atts' => [
                'class' => 'dropdown-item'
            ],
            'wrapperTag' => 'li',
            'wrapperAtts' => [
                'class' => 'nav-item'
            ]
        ]
    )
];
$services->addItems($items);
