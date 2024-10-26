<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\MenuItem;


class MenuItemTest extends TestCase
{
    public function testConstructorWithDefaults()
    {
        $menuItem = new MenuItem();

        $this->assertEquals('a', $menuItem->tag);
        $this->assertEquals(['class' => 'menu-link'], $menuItem->atts);
        $this->assertEquals('li', $menuItem->wrapperTag);
        $this->assertEquals(['class' => 'menu-item'], $menuItem->wrapperAtts);
    }

    public function testConstructorWithData()
    {
        $data = [
            'title' => 'Home',
            'url' => '/home',
            'weight' => 10,
            //'permission' => 'view_home'
        ];
        $menuItem = new MenuItem($data);

        $this->assertEquals('Home', $menuItem->title());
        $this->assertEquals('/home', $menuItem->url());
        $this->assertEquals(10, $menuItem->weight());
        //$this->assertEquals('view_home', $menuItem->permission);
    }

    public function testSetTitle()
    {
        $menuItem = new MenuItem();
        $menuItem->setTitle('About');

        $this->assertEquals('About', $menuItem->title());
    }

    public function testSetUrl()
    {
        $menuItem = new MenuItem();
        $menuItem->setUrl('https://example.com');

        $this->assertEquals('https://example.com', $menuItem->url());
    }

    public function testSetWeight()
    {
        $menuItem = new MenuItem();
        $menuItem->setWeight(5);

        $this->assertEquals(5, $menuItem->weight());
    }

    // public function testSetPermission()
    // {
    //     $menuItem = new MenuItem();
    //     $menuItem->setPermission('edit_posts');

    //     $this->assertEquals('edit_posts', $menuItem->permission);
    // }

    public function testHasPermission()
    {
        $menuItem = new MenuItem();
        $this->assertTrue($menuItem->hasPermission());

        $menuItem->setPermission('edit_posts');
        // Assuming a mock or stub for permission checking logic
        $this->assertFalse($menuItem->hasPermission());
    }

    public function testMagicGetter()
    {
        $menuItem = new MenuItem([
            'title' => 'Contact',
            'url' => '/contact'
        ]);

        $this->assertEquals('Contact', $menuItem->title);
        $this->assertEquals('/contact', $menuItem->url);
    }
}
