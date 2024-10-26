<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;

class SubMenuTest extends TestCase
{
    public function testConstructorWithDefaults()
    {
        $subMenu = new SubMenu('main', 'Main Menu');

        $this->assertEquals('ul', $subMenu->tag);
        $this->assertEquals(['class' => 'menu-submenu'], $subMenu->atts);
        $this->assertEquals('li', $subMenu->wrapperTag);
        $this->assertEquals(['class' => 'submenu-wrapper'], $subMenu->wrapperAtts);
        $this->assertEquals(['class' => 'submenu-title'], $subMenu->titleAtts);
        $this->assertEquals('Main Menu', $subMenu->title);
        $this->assertEquals('main', $subMenu->name);
    }

    public function testConstructorWithData()
    {
        $data = [
            'tag' => 'div',
            'atts' => ['class' => 'custom-submenu'],
            'wrapperTag' => 'section',
            'wrapperAtts' => ['class' => 'custom-wrapper'],
            'titleAtts' => ['class' => 'custom-title']
        ];
        $subMenu = new SubMenu('main', 'Main Menu', $data);

        $this->assertEquals('div', $subMenu->tag);
        $this->assertEquals(['class' => 'custom-submenu'], $subMenu->atts);
        $this->assertEquals('section', $subMenu->wrapperTag);
        $this->assertEquals(['class' => 'custom-wrapper'], $subMenu->wrapperAtts);
        $this->assertEquals(['class' => 'custom-title'], $subMenu->titleAtts);
    }

    public function testSetName()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $subMenu->setName('secondary');

        $this->assertEquals('secondary', $subMenu->name());
    }

    public function testSetCollapsible()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $subMenu->setCollapsible(true);

        $this->assertTrue($subMenu->isCollapsible());
    }

    public function testAddItem()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $menuItem = new MenuItem(['title' => 'Home']);
        $subMenu->addItem($menuItem);

        $this->assertCount(1, $subMenu->items());
        $this->assertEquals('Home', $subMenu->items()[0]->title());
    }

    public function testAddItems()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $menuItems = [
            new MenuItem(['title' => 'Home']),
            new MenuItem(['title' => 'About'])
        ];
        $subMenu->addItems($menuItems);

        $this->assertCount(2, $subMenu->items());
        $this->assertEquals('Home', $subMenu->items()[0]->title());
        $this->assertEquals('About', $subMenu->items()[1]->title());
    }

    public function testRemoveItem()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $menuItem = new MenuItem(['title' => 'Home']);
        $subMenu->addItem($menuItem);
        $subMenu->removeItem('Home');

        $this->assertCount(0, $subMenu->items());
    }

    public function testRemoveAllItems()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $menuItems = [
            new MenuItem(['title' => 'Home']),
            new MenuItem(['title' => 'About'])
        ];
        $subMenu->addItems($menuItems);
        $subMenu->removeAllItems();

        $this->assertCount(0, $subMenu->items());
    }

    public function testSetTitleTag()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $subMenu->setTitleTag('h1');

        $this->assertEquals('h1', $subMenu->titleTag());
    }

    public function testSetTitleAtts()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $subMenu->setTitleAtts(['class' => 'new-title']);

        $this->assertEquals(['class' => 'new-title'], $subMenu->titleAtts());
    }

    public function testMagicGetter()
    {
        $subMenu = new SubMenu('main', 'Main Menu');
        $subMenu->setCollapsible(true);

        $this->assertTrue($subMenu->__get('isCollapsible'));
    }
}
