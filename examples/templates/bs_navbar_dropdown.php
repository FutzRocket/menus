<?php

use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Manager;
use FutzRocket\Menus\Menu;

include_once "_menu_setup.php";
?>

<ul class="nav me-auto mb-2 mb-lg-0">
    <?php $items = $primary_menu->items(); ?>
    <?php foreach ($items as $item) : ?>
        <?php if ($item instanceof SubMenu) : ?>
            <?php $submenu = $item; ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                    href="<?= $item->url() ?>"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?= $submenu->title() ?>
                </a>
                <ul class="dropdown-menu">
                    <?php foreach ($submenu->items() as $item) : ?>
                        <li>
                            <a class="dropdown-item" href="<?= $item->url() ?>">
                                <?= $item->title() ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
        <?php else : ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= $item->url() ?>">
                    <?= $item->title() ?>
                </a>
            </li>

        <?php endif ?>
    <?php endforeach ?>
</ul>