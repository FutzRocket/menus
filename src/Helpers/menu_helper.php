<?php

use FutzRocket\Menus\Manager;
use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Menu;

/**
 * Render a menu
 *
 * @param Menu $menu
 * @param bool $return
 * @return void|string
 */
function render_menu(Menu $menu, bool $return = false)
{
    $html = "";
    $html .= "<{$menu->tag()}{$menu->atts_str($menu->atts())}>"; // Opening tag for the menu

    foreach ($menu->items() as $item) {
        if ($item instanceof SubMenu) {
            $submenu = $item;
            $html .= render_submenu($submenu);
        } else {
            $html .= render_item($item);
        }
    }

    $html .= "</{$menu->tag()}>"; // Closing tag for the menu

    if ($return) {
        return $html;
    };

    echo $html;
}

/**
 * Render a menu item
 *
 * @param MenuItem $item
 * @return string
 */
function render_item(MenuItem $item): string
{
    $href = $item->url() ?? "#";
    $atts = "href=\"{$href}\" {$item->atts_str($item->atts())}";
    $wrapperAtts = $item->atts_str($item->wrapperAtts());

    $html = "";
    $html .= "<{$item->wrapperTag()}{$wrapperAtts}>"; // Opening tag for the wrapper , 'li' both for menu item and submenu
    $html .= "<{$item->tag()} {$atts}>"; // Opening tag for the anchor tag or ul for submenu
    $html .= "{$item->title()}"; //
    $html .= "</{$item->tag()}>"; // Closing tag for the anchor tag or ul for submenu
    $html .= "</{$item->wrapperTag()}>"; // Closing tag for the wrapper 

    return $html;
}

/**
 * Render a submenu
 *
 * @param SubMenu $submenu
 * @return string
 */
function render_submenu(SubMenu $submenu): string
{
    // Get the attributes for each element that builds the submenu
    $wrapperAtts = $submenu->atts_str($submenu->wrapperAtts()); // Attributes for the submenu wrapper, default element 'li'
    $titleAtts = $submenu->atts_str($submenu->titleAtts()); // Attributes for the submenu title, default element 'a'  
    $atts = $submenu->atts_str($submenu->atts()); // Attributes for the submenu wrapper, default element 'ul'

    $html = "";
    $html .= "<{$submenu->wrapperTag()}{$wrapperAtts}>"; // Opening tag for the wrapper , 'li' both for menu item and submenu
    $html .= "<{$submenu->titleTag()}{$titleAtts}>"; // Opening tag for the submenu title
    $html .= "{$submenu->title()}"; // submenu title
    $html .= "</{$submenu->titleTag()}>"; // Closing tag for the submenu title
    $html .= "<{$submenu->tag()}{$atts}>"; // Opening tag for the submenu
    foreach ($submenu->items() as $item) {
        $html .= render_item($item);
    }
    $html .= "</{$submenu->tag()}>"; // Closing tag for the submenu
    $html .= "</{$submenu->wrapperTag()}>"; // Closing tag for the wrapper

    return $html;
}
