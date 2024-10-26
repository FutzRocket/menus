<?php

namespace FutzRocket\Menus;

use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\Traits\HasMenuIcons;
use FutzRocket\Menus\Traits\MenuHTML;

/**
 * Represents a submenu of menu items.
 * This is used to store the dropdown button for dropdown menus,
 * or the header for accordion-style menus.
 *
 * @property string $name
 * @property string $title
 */
class SubMenu extends MenuItem
{
    use HasMenuIcons, MenuHTML;

    /**
     * Holds all Menu items of a submenu
     *
     * @var array<MenuItem>
     */
    protected array $items = [];

    /**
     * The name this submenu is discovered by.
     */
    protected string $name = '';

    /**
     * If true, should be presented as a collapsible menu.
     */
    protected bool $collapsible = false;

    /** 
     * The HTML tag which wraps the title of the element.
     */
    protected string $titleTag = 'span';

    /** 
     * The HTML attributes for the title tag.
     */
    protected array $titleAtts = [];


    /**
     * Constructor
     *
     * @param string $name Name of Menu submenu
     * @param string $title Title of Menu submenu
     * @param array $data Optional properties to initialize the menu with
     */
    public function __construct(string $name, string $title, ?array $data = null)
    {
        parent::__construct($data);

        // Set the default values for the menu item.
        $this->tag = 'ul';
        $this->atts = ['class' => 'menu-submenu'];
        $this->wrapperTag = 'li';
        $this->wrapperAtts = ['class' => 'submenu-wrapper'];
        $this->titleAtts = ['class' => 'submenu-title'];

        // Set the input data.
        if ($data) {
            $this->setData($data);
        }

        $this->title = $title;
        $this->name = $name;
    }
    /**
     * Sets the name this submenu can be referenced by.
     *
     * @param string $name Name of Menu item
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the name this submenu can be referenced by.
     */
    public function name(): string
    {

        return $this->name;
    }

    /**
     * Sets this submenu is collapsible.
     *
     * @param bool $collapse Is collapsible or not
     */
    public function setCollapsible(bool $collapse = true): self
    {
        $this->collapsible = $collapse;

        return $this;
    }

    /**
     * Gets this submenu is collapsible
     */
    public function isCollapsible(): bool
    {

        return $this->collapsible;
    }

    /**
     * Adds a single item to the menu.
     *
     * @param MenuItem $item Instance of MenuItem
     */
    public function addItem(MenuItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Add multiple Menu items at once.
     *
     * @param array<MenuItem> $items list of MenuItem Instances
     */
    public function addItems(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * Returns all items in the submenu, sorted by weight,
     * where larger weights make them fall to the bottom.
     *
     * @return array<MenuItem>
     */
    public function items(): array
    {

        return $this->items;
    }

    /**
     * Remove Menu Item from this submenu
     *
     * @param string $title title of MenuItem that want to remove
     */
    public function removeItem(string $title): void
    {
        $counter = count($this->items);
        for ($i = 0; $i < $counter; $i++) {
            if ($this->items[$i]->title() === $title) {
                unset($this->items[$i]);
                break;
            }
        }
    }

    /**
     * Removes all of the items from this submenu.
     */
    public function removeAllItems(): self
    {
        $this->items = [];

        return $this;
    }

    /**
     * Gets the HTML tag which wraps the title of the element.
     *
     * @return string
     */
    public function titleTag(): string
    {
        return $this->titleTag;
    }

    /**
     * Sets the HTML tag which wraps the title of the element.
     *
     * @param string $tag HTML tag
     */
    public function setTitleTag(string $tag): self
    {
        $this->titleTag = $tag;

        return $this;
    }

    /**
     * Gets callable of SubMenu Class
     *
     * @param string $key one of the Method name of SubMenu Class
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        if (method_exists($this, $key)) {
            return $this->{$key}();
        }
    }

    /**
     * Sets the HTML attributes for the title tag.
     *
     * @param array $atts HTML attributes
     */
    public function setTitleAtts(array $atts): self
    {
        $this->titleAtts = $atts;

        return $this;
    }

    /**
     * Gets the HTML attributes for the title tag.
     *
     * @return array
     */
    public function titleAtts(): array
    {
        return $this->titleAtts;
    }
}
