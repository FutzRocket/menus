<?php

namespace FutzRocket\Menus\Traits;

use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Menu;


/**
 * Trait MenuHTML
 * 
 * This trait is used to define the HTML structure of the menu.
 * It provides methods to set and get the HTML tags and 
 * attributes for the menu, menu items, and menu item links.
 * 
 * Properties:
 * - tag string
 * - atts array
 * - wrapperTag string
 * - wrapperAtts array
 * 
 * @package FutzRocket\Menus\Traits
 */
trait MenuHTML
{
    /**
     * The HTML tag.
     * 
     * @var string
     */
    protected ?string $tag;

    /**
     * The HTML attributes for the tag.
     * 
     * @var array
     */
    protected ?array $atts;

    /**
     * The HTML tag for the wrapping element.
     * 
     * @var string
     */
    protected ?string $wrapperTag;

    /**
     * The HTML attributes for the wrapping element.
     * 
     * @var array
     */
    protected ?array $wrapperAtts;

    /**
     * Get the HTML tag.
     * 
     * @return string
     */
    public function tag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set the HTML tag.
     * 
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Get the HTML attributes.
     * 
     * @return array
     */
    public function atts(): ?array
    {
        return $this->atts;
    }

    /**
     * Set the HTML attributes.
     * 
     * @param array $atts
     * @return $this
     */
    public function setAtts(array $atts): self
    {
        $this->atts = $atts;
        return $this;
    }

    /**
     * Get the wrapper tag.
     * 
     * @return string
     */
    public function wrapperTag(): ?string
    {
        return $this->wrapperTag;
    }

    /**
     * Set the wrapper tag.
     * 
     * @param string $tag
     * @return $this
     */
    public function setWrapperTag(string $tag): self
    {
        $this->wrapperTag = $tag;
        return $this;
    }

    /**
     * Get the wrapper attributes.
     * 
     * @return array
     */
    public function wrapperAtts(): ?array
    {
        return $this->wrapperAtts;
    }

    /**
     * Set the wrapper attributes.
     * 
     * @param array $atts
     * @return $this
     */
    public function setWrapperAtts(array $atts): self
    {
        $this->wrapperAtts = $atts;
        return $this;
    }
    /**
     * Get the attributes as a preformatted string.
     */
    public function atts_str(?array $atts): string
    {
        if (!$atts) {
            return "";
        }

        $attsString = "";
        foreach ($atts as $key => $value) {
            $attsString .= " {$key}=\"{$value}\"";
        }
        return $attsString;
    }
}
