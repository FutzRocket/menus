<?php
include '_menu_setup.php';

use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Manager;
use FutzRocket\Menus\Menu;

$items = $primary_menu->items();
?>

<div class="pt-3">

    <ul class="nav flex-column">
        <!-- Dashboard Sidebar-->
        <li>
            <a class="nav-link" href="#" title="Sidebar">
                <span>Sidebar Menu</span>
            </a>
        </li>

        <?php foreach ($items as $item) : ?>

            <li class="nav-item">

                <?php if ($item instanceof SubMenu) : ?>
                    <?php $submenu = $item ?>
                    <a href="#<?= $item->name() . '-collection' ?>"
                        data-bs-toggle="collapse"
                        data-bs-target="#<?= $item->name() . "-collection" ?>"
                        aria-expanded="false"
                        aria-controls="<?= $item->name() . "-collection" ?>"
                        role="button"
                        class="nav-link">
                        <?= $submenu->title() . " +" ?>
                    </a>
                    <div id="<?= $item->name() . "-collection" ?>" class="collapse">
                        <ul class="nav flex-column text-light bg-primary">

                            <?php foreach ($submenu->items() as $item): ?>

                                <li class="nav-item">
                                    <a class="nav-link text-light" href="<?= $item->url ?>"><?= $item->title() ?></a>
                                </li>

                            <?php endforeach; ?>

                        </ul>
                    </div>

                <?php else : ?>

                    <a class="nav-link" href="<?= $item->url() ?>"><?= $item->title() ?></a>

                <?php endif ?>

            </li>

        <?php endforeach ?>

    </ul>
</div>