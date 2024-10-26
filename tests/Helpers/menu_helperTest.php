<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\Menu;
use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;

class Menu_HelperTest extends TestCase
{
    public function testRenderMenuWithItems()
    {
        $menu = new Menu();
        $menu->addItem(new MenuItem(['title' => 'Item 1', 'url' => '/item1']));
        $menu->addItem(new MenuItem(['title' => 'Item 2', 'url' => '/item2']));

        $html = render_menu($menu, true);

        $this->assertStringContainsString('<ul class="menu">', $html);
        $this->assertStringContainsString('<li class="menu-item"><a href="/item1"  class="menu-link">Item 1</a></li>', $html);
        $this->assertStringContainsString('<li class="menu-item"><a href="/item2"  class="menu-link">Item 2</a></li>', $html);
        $this->assertStringContainsString('</ul>', $html);
    }

    public function testRenderMenuWithSubmenus()
    {
        $menu = new Menu();
        $submenu = new SubMenu('submenu1', 'Submenu 1');
        $submenu->addItem(new MenuItem(['title' => 'Subitem 1', 'url' => '/subitem1']));
        $menu->addItem($submenu);

        $html = render_menu($menu, true);

        $this->assertStringContainsString('<ul class="menu">', $html);
        $this->assertStringContainsString('<li class="submenu-wrapper">', $html);
        $this->assertStringContainsString('<span class="submenu-title">Submenu 1</span>', $html);
        $this->assertStringContainsString('<ul class="menu-submenu">', $html);
        $this->assertStringContainsString('<li class="menu-item"><a href="/subitem1"  class="menu-link">Subitem 1</a></li>', $html);
        $this->assertStringContainsString('</ul>', $html);
        $this->assertStringContainsString('</li>', $html);
        $this->assertStringContainsString('</ul>', $html);
    }

    public function testRenderMenuReturnsHtml()
    {
        $menu = new Menu();
        $menu->addItem(new MenuItem(['title' => 'Item 1', 'url' => '/item1']));

        $html = render_menu($menu, true);

        $this->assertIsString($html);
        $this->assertStringContainsString('<ul class="menu">', $html);
    }

    public function testRenderMenuEchoesHtml()
    {
        $this->expectOutputString('<ul class="menu"><li class="menu-item"><a href="/item1"  class="menu-link">Item 1</a></li></ul>');

        $menu = new Menu();
        $menu->addItem(new MenuItem(['title' => 'Item 1', 'url' => '/item1']));

        render_menu($menu, false);
    }

    public function testRenderItem()
    {
        $item = new MenuItem(['title' => 'Item 1', 'url' => '/item1']);
        $html = render_item($item);

        $this->assertStringContainsString('<li class="menu-item"><a href="/item1"  class="menu-link">Item 1</a></li>', $html);
    }

    public function testRenderSubmenu()
    {
        $submenu = new SubMenu('submenu1', 'Submenu 1');
        $submenu->addItem(new MenuItem(['title' => 'Subitem 1', 'url' => '/subitem1']));

        $html = render_submenu($submenu);

        $this->assertStringContainsString('<li class="submenu-wrapper">', $html);
        $this->assertStringContainsString('<span class="submenu-title">Submenu 1</span>', $html);
        $this->assertStringContainsString('<ul class="menu-submenu">', $html);
        $this->assertStringContainsString('<li class="menu-item"><a href="/subitem1"  class="menu-link">Subitem 1</a></li>', $html);
        $this->assertStringContainsString('</ul>', $html);
        $this->assertStringContainsString('</li>', $html);
    }
}
