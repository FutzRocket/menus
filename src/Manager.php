<?php

namespace FutzRocket\Menus;

/**
 * Menus Manager Class
 *
 * The main class used to work with menus in the system.
 *
 * @method self     createMenu(string $name)
 * @method Menu     menu(string $name)
 */
class Manager
{
    /**
     * A collection of menus currently known about.
     *
     * @var array<Menu> array of `\Bonfire\Menus\Menu`
     */
    private array $_menus = [];

    /**
     * Creates a new menu in the system.
     *
     * @param string $name New Menu's name
     */
    public function createMenu(string $name, array $data = null): self
    {
        $this->_menus[$name] = new Menu($data);

        return $this;
    }

    /**
     * Returns the specified menu instance
     *
     * @param string $name Menu's name
     *
     * @return Menu
     */
    public function menu(string $name): Menu
    {
        if (! isset($this->_menus[$name])) {
            $this->createMenu($name);
        }

        return $this->_menus[$name];
    }

    public function menus(): array
    {
        return $this->_menus;
    }
}
