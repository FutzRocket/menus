<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\Manager;
use FutzRocket\Menus\Menu;


class ManagerTest extends TestCase
{
    public function testConstructorInitializesMenusArray()
    {
        $manager = new Manager();
        $this->assertIsArray($manager->menus());
        $this->assertEmpty($manager->menus());
    }

    public function testCreateMenu()
    {
        $manager = new Manager();
        $manager->createMenu('main');

        $this->assertArrayHasKey('main', $manager->menus());
        $this->assertInstanceOf(Menu::class, $manager->menus('main'));
    }

    public function testCreateMenuWithData()
    {
        $data = ['title' => 'Main Menu'];
        $manager = new Manager();
        $manager->createMenu('main', $data);

        $this->assertArrayHasKey('main', $manager->menus());
        $this->assertInstanceOf(Menu::class, $manager->menus()['main']);
        $this->assertEquals('Main Menu', $manager->menus()['main']->title());
    }

    public function testMenuReturnsExistingMenu()
    {
        $manager = new Manager();
        $manager->createMenu('main');
        $menu = $manager->menu('main');

        $this->assertInstanceOf(Menu::class, $menu);
        $this->assertSame($manager->menus()['main'], $menu);
    }

    public function testMenuCreatesNewMenuIfNotExists()
    {
        $manager = new Manager();
        $menu = $manager->menu('main');

        $this->assertInstanceOf(Menu::class, $menu);
        $this->assertArrayHasKey('main', $manager->menus());
        $this->assertSame($manager->menus()['main'], $menu);
    }
}
