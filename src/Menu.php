<?php

namespace FutzRocket\Menus;

use FutzRocket\Menus\Traits\MenuHTML;
use FutzRocket\Menus\MenuItem;
use FutzRocket\Menus\SubMenu;

/**
 * Menu Class
 *
 * Represents a list of Menu items and a menu submenu items.
 *
 * @package FutzRocket\Menus
 *
 * @property array $items List of menu items
 * @property string $title Title of the menu
 *
 * @method void addItem(string $item) Adds an item to the menu
 * @method void removeItem(string $item) Removes an item from the menu
 * @method array getItems() Returns the list of menu items
 * @method string getTitle() Returns the title of the menu
 * @method void setTitle(string $title) Sets the title of the menu
 * @method void setDescription(string $description) Sets the description of the menu
 * @method string description() Returns the description of the menu
 */
class Menu
{
    use MenuHTML;

    /**
     * Holds all Menu items or Menu submenus that appear at
     * top level in this menu.
     *
     * @var array<(SubMenu | MenuItem)>
     */
    protected array $items = [];

    /**
     * Title of Menu
     */
    protected ?string $title = null;

    /**
     * Description of the Menu
     */
    protected ?string $description = null;

    /**
     * Location of the Menu
     */
    protected ?string $location = null;

    /**
     * Constructor
     *
     * @param array $properties Optional properties to initialize the menu with
     */
    public function __construct(?array $data = null)
    {
        // Set the default values for the menu item.
        $this->tag = 'ul';
        $this->atts = ['class' => 'menu'];
        $this->wrapperTag = null;
        $this->wrapperAtts = null;

        // Set the input data.
        if ($data !== null) {
            $this->setData($data);
        }
    }

    /**
     * Sets the batch data for the menu.
     */
    public function setData(?array $data): self
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }

        return $this;
    }
    /**
     * Sets the title for the menu.
     *
     * @param string $title The title to set.
     * @return self Returns the instance of the Menu for method chaining.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Sets the description for the menu.
     *
     * @param string $description The description to set.
     * @return self Returns the instance of the Menu for method chaining.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the location for the menu.
     *
     * @param string $location The location to set.
     * @return self Returns the instance of the Menu for method chaining.
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Retrieves the title of the menu.
     *
     * @return string The title of the menu.
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * Retrieves the description of the menu.
     *
     * @return string|null The description of the menu.
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Retrieves the location of the menu.
     *
     * @return string|null The location of the menu.
     */
    public function location(): ?string
    {
        return $this->location;
    }

    /**
     * Returns all Menu items or Menu submenus in the menu.
     *
     * @return array<(SubMenu | MenuItem)>
     */
    public function items(): array
    {
        return $this->items;
    }

    /**
     * Adds a new Menu item
     *
     * @param MenuItem $item Instance of MenuItem
     */
    public function addItem(MenuItem $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Creates a new submenu with default values for
     * everything except the `name` and `title`, which are
     * required parameters.
     *
     * @param string $name  name or slug of the new Menu submenu
     * @param string $title Title of the new Menu submenu
     *
     * @return SubMenu
     */
    public function createSubmenu(string $name, string $title): SubMenu
    {
        $submenu = new SubMenu($name, $title);

        $this->items[] = $submenu;

        return $submenu;
    }

    /**
     * Creates a new submenu, if one with $name doesn't exist,
     * and adds the items to the submenu.
     *
     * @param string $name  name of Menu submenu
     * @param array  $items Array of Menu Item
     *
     * @return SubMenu
     */
    public function collect(string $name, array $items): SubMenu
    {
        /**
         *  Get Menu submenu
         *
         * @var SubMenu|null $submenu
         */
        $submenu = $this->submenu($name);

        if ($submenu === null) {

            $submenu = new SubMenu($name, ucfirst($name));

            $this->items[] = $submenu;
        }

        $submenu->addItems($items);

        return $submenu;
    }

    /**
     * Locates a submenu by name.
     *
     * @param string $name name of the Menu submenu
     *
     * @return SubMenu|null
     */
    public function submenu(string $name)
    {
        foreach ($this->items as $item) {
            if ($item instanceof SubMenu && $item->name() === $name) {
                return $item;
            }
        }

        return null;
    }

    /*/test*
     * Returns an array of all submenus stored, if any.
     *
     * @return array<SubMenu>
     */
    public function submenus(): array
    {
        $submenus = [];

        foreach ($this->items as $item) {
            if ($item instanceof SubMenu) {
                $submenus[] = $item;
            }
        }

        return $submenus;
    }
}
