<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\Menu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\SubMenu;


class MenuTest extends TestCase
{
    public function testConstructorWithDefaults()
    {
        $menu = new Menu();

        $this->assertEquals('ul', $menu->tag());
        $this->assertEquals(['class' => 'menu'], $menu->atts());
        $this->assertNull($menu->wrapperTag());
        $this->assertNull($menu->wrapperAtts());
        $this->assertNull($menu->title());
        $this->assertNull($menu->description());
        $this->assertNull($menu->location());
    }

    public function testConstructorWithData()
    {
        $data = [
            'tag' => 'div',
            'atts' => ['class' => 'custom-menu'],
            'wrapperTag' => 'section',
            'wrapperAtts' => ['class' => 'custom-wrapper'],
            'title' => 'Main Menu',
            'description' => 'This is the main menu',
            'location' => 'header'
        ];
        $menu = new Menu($data);

        $this->assertEquals('div', $menu->tag());
        $this->assertEquals(['class' => 'custom-menu'], $menu->atts());
        $this->assertEquals('section', $menu->wrapperTag());
        $this->assertEquals(['class' => 'custom-wrapper'], $menu->wrapperAtts());
        $this->assertEquals('Main Menu', $menu->title());
        $this->assertEquals('This is the main menu', $menu->description());
        $this->assertEquals('header', $menu->location());
    }

    public function testSetTitle()
    {
        $menu = new Menu();
        $menu->setTitle('Main Menu');

        $this->assertEquals('Main Menu', $menu->title());
    }

    public function testSetDescription()
    {
        $menu = new Menu();
        $menu->setDescription('This is the main menu');

        $this->assertEquals('This is the main menu', $menu->description());
    }

    public function testSetLocation()
    {
        $menu = new Menu();
        $menu->setLocation('header');

        $this->assertEquals('header', $menu->location());
    }

    public function testAddItem()
    {
        $menu = new Menu();
        $menuItem = new MenuItem(['title' => 'Home']);
        $menu->addItem($menuItem);

        $this->assertCount(1, $menu->items());
        $this->assertEquals('Home', $menu->items()[0]->title());
    }

    public function testCreateSubmenu()
    {
        $menu = new Menu();
        $submenu = $menu->createsubmenu('main', 'Main Menu');

        $this->assertInstanceOf(SubMenu::class, $submenu);
        $this->assertCount(1, $menu->items());
        $this->assertEquals('Main Menu', $menu->items()[0]->title());
    }

    public function testCollect()
    {
        $menu = new Menu();
        $menuItems = [
            new MenuItem(['title' => 'Home']),
            new MenuItem(['title' => 'About'])
        ];
        $submenu = $menu->collect('main', $menuItems);

        $this->assertInstanceOf(SubMenu::class, $submenu);
        $this->assertCount(1, $menu->items());
        $this->assertCount(2, $submenu->items());
        $this->assertEquals('Home', $submenu->items()[0]->title());
        $this->assertEquals('About', $submenu->items()[1]->title());
    }

    public function testSubmenu()
    {
        $menu = new Menu();
        $menu->createsubmenu('main', 'Main Menu');
        $submenu = $menu->submenu('main');

        $this->assertInstanceOf(SubMenu::class, $submenu);
        $this->assertEquals('Main Menu', $submenu->title());
    }

    public function testSubmenus()
    {
        $menu = new Menu();
        $menu->createsubmenu('main', 'Main Menu');
        $menu->createsubmenu('secondary', 'Secondary Menu');
        $submenus = $menu->submenus();

        $this->assertCount(2, $submenus);
        $this->assertEquals('Main Menu', $submenus[0]->title());
        $this->assertEquals('Secondary Menu', $submenus[1]->title());
    }
}
