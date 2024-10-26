<?php

use PHPUnit\Framework\TestCase;
use FutzRocket\Menus\Tests\Traits\MenuHTMLTestClass;

class MenuHTMLTest extends TestCase
{
    public function testSetAndGetTag()
    {
        $obj = new MenuHTMLTestClass();
        $obj->setTag('div');
        $this->assertEquals('div', $obj->tag());
    }

    public function testSetAndGetAtts()
    {
        $obj = new MenuHTMLTestClass();
        $atts = ['class' => 'menu', 'id' => 'main-menu'];
        $obj->setAtts($atts);
        $this->assertEquals($atts, $obj->atts());
    }

    public function testSetAndGetWrapperTag()
    {
        $obj = new MenuHTMLTestClass();
        $obj->setWrapperTag('li');
        $this->assertEquals('li', $obj->wrapperTag());
    }

    public function testSetAndGetWrapperAtts()
    {
        $obj = new MenuHTMLTestClass();
        $atts = ['class' => 'menu-wrapper'];
        $obj->setWrapperAtts($atts);
        $this->assertEquals($atts, $obj->wrapperAtts());
    }

    public function testAttsStr()
    {
        $obj = new MenuHTMLTestClass();
        $atts = ['class' => 'menu', 'id' => 'main-menu'];
        $this->assertEquals(' class="menu" id="main-menu"', $obj->atts_str($atts));
    }
}
