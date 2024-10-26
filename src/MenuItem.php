<?php

namespace FutzRocket\Menus;

use FutzRocket\Menus\Traits\HasMenuIcons;
use FutzRocket\Menus\Traits\MenuHTML;

/**
 * Represents an individual item in a menu.
 * 
 * Properties $tag and $atts are used to set the HTML tag and attributes
 * for the element that wraps the menu link, typically 'li'. 
 * The $linkTag will default to 'a', or 'span' if no URL is provide, 
 * but can be overridden. 
 * 
 * @property string   $title        The displayed title of the menu item.
 * @property string   $url          The URL the menu item links to. If the object is a submenu 
 *                                  this can be set to #submenuName or be used by 
 *                                  JavaScript to trigger a show/hide of the submenu.
 * @property int      $weight       The weight of the menu item. Set the order of the menu item.
 * @property string   $faIcon       The Font Awesome icon to use for the menu item.
 * @property string   $iconUrl      The URL to an icon to use for the menu item. 
 * @property string   $tag          The HTML tag to use for the menu item. 
 *                                  Defaults to 'li for single items and 'ul' for submenus.
 * @property array    $atts         The HTML attributes for the menu item.    
 * @property string   $wrapperTag   The HTML tag to use for the wrapper element.
 * @property array    $wrapperAtts  The HTML attributes for the wrapper element. 
 * @property string   $permission   The permission required to see this menu item.
 * 
 * @method string icon()            Get the preformatted icon for the menu item.
 * @method bool hasPermission()     Check if the user has permission to see this menu item.
 */
class MenuItem
{
    use HasMenuIcons, MenuHTML;
    /**
     * Title of Menu Item
     */
    protected ?string $title = null;

    /**
     * URL of Menu Item
     */
    protected ?string $url = null;

    /**
     * The 'weight' used for sorting.
     */
    protected ?int $weight = null;

    /**
     * The permission to check to see if the user can view the menu item or not.
     */
    protected ?string $permission = null;

    /**
     * Undocumented function
     *
     * @param array|null $data Array of Menu Item's data
     */
    public function __construct(?array $data = null)
    {

        // Initialize properties from MenuHTML trait
        $this->tag = 'a';
        $this->atts = ['class' => 'menu-link'];
        $this->wrapperTag = 'li';
        $this->wrapperAtts = ['class' => 'menu-item'];

        // Initialize other properties
        $this->permission = null;

        // Set the input data.
        if ($data !== null) {
            $this->setData($data);
        }
    }

    /**
     * Sets the input data for the item, submenu, or menu.
     */
    public function setData(array $data): self
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
     * Sets Title of this Menu Item
     *
     * @param string $title Title of Menu Item
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Sets URL of this Menu Item
     *
     * @param string $url Url of Menu Item
     */
    public function setUrl(string $url): self
    {
        $this->url = strpos($url, '://') !== false ? $url : '/' . ltrim($url, '/ ');

        return $this;
    }

    /**
     * Sets the "weight" of the menu item.
     * The large the value, the later in the menu it will appear.
     * Uses the value from Config/Bonfire.php $menuWeights if it is set, key is
     * the unique named route.
     *
     * @param int $weight Weight of Menu Item
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Sets the permission required to see this menu item.
     *
     * @param string $permission Permission for user can
     */
    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Gets Title of this Menu Item
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * Gets Url of this Menu Item
     */
    public function url(): ?string
    {
        return $this->url;
    }

    /**
     * Gets Weight of this Menu Item
     */
    public function weight(): int
    {

        return $this->weight ?? 0;
    }

    /** 
     * Check if the user has permission to see this menu item.
     */
    public function hasPermission(): bool
    {
        // If no permission is set, then everyone can see it.
        if (empty($this->permission)) {
            return true;
        }

        // Setup the permission check.
        return false; // Placeholder for actual permission logic
    }

    /**
     * Gets callable of MenuItem Class
     *
     * @param string $key one of the Method name of MenuItem Class
     *
     * @return mixed
     */
    public function __get(string $key)
    {
        if (method_exists($this, $key)) {
            return $this->{$key}();
        }
    }
}
