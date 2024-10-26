# FutzRocket Menus Library


The FutzRocket Menus Library is a PHP library designed to help developers create and manage menus and submenus in their applications. This library provides a set of classes and traits to define menu items, submenus, and the overall menu structure, along with methods to render these menus in HTML.
## Installation
You can install the FutzRocket Menus Library via Composer. Run the following command in your project directory:

```bash
composer require futzrocketstudio/menus
```
## Classes and Methods

### `MenuItem`

Represents an individual item in a menu.

#### Properties
- `string $title` - The displayed title of the menu item.
- `string $url` - The URL the menu item links to.
- `int $weight` - The weight of the menu item for sorting.
- `string $faIcon` - The Font Awesome icon to use for the menu item.
- `string $iconUrl` - The URL to an icon to use for the menu item.
- `string $tag` - The HTML tag to use for the menu item.
- `array $atts` - The HTML attributes for the menu item.
- `string $wrapperTag` - The HTML tag to use for the wrapper element.
- `array $wrapperAtts` - The HTML attributes for the wrapper element.
- `string $permission` - The permission required to see this menu item.

#### Methods
- `setTitle(string $title): self`
- `setUrl(string $url): self`
- `setWeight(int $weight): self`
- `setPermission(string $permission): self`
- `title(): ?string`
- `url(): ?string`
- `weight(): int`
- `hasPermission(): bool`
- `__get(string $key)`

### `SubMenu`

Represents a submenu of menu items.

#### Properties
- `string $name` - The name of the submenu.
- `string $title` - The title of the submenu.
- `array $items` - Holds all menu items of a submenu.
- `bool $collapsible` - If true, should be presented as a collapsible menu.
- `string $titleTag` - The HTML tag which wraps the title of the element.
- `array $titleAtts` - The HTML attributes for the title tag.

#### Methods
- `setName(string $name): self`
- `name(): string`
- `setCollapsible(bool $collapse = true): self`
- `isCollapsible(): bool`
- `addItem(MenuItem $item): self`
- `addItems(array $items): self`
- `items(): array`
- `removeItem(string $title): void`
- `removeAllItems(): self`
- `titleTag(): string`
- `setTitleTag(string $tag): self`
- `__get(string $key)`
- `setTitleAtts(array $atts): self`
- `titleAtts(): array`

### `Menu`

Represents a list of menu items and submenus.

#### Properties
- `array $items` - List of menu items.
- `string $title` - Title of the menu.
- `string $description` - Description of the menu.
- `string $location` - Location of the menu.

#### Methods
- `setTitle(string $title): self`
- `setDescription(string $description): self`
- `setLocation(string $location): self`
- `title(): ?string`
- `description(): ?string`
- `location(): ?string`
- `items(): array`
- `addItem(MenuItem $item): self`
- `createSubmenu(string $name, string $title): SubMenu`
- `collect(string $name, array $items): SubMenu`
- `submenu(string $name)`
- `submenus(): array`

### `Manager`

The main class used to work with menus in the system.

#### Properties
- `array $_menus` - A collection of menus currently known about.

#### Methods
- `createMenu(string $name, array $data = null): self`
- `menu(string $name): Menu`
- `menus(): array`

## Traits

### `MenuHTML`

Provides methods to set and get the HTML tags and attributes for the menu, menu items, and menu item links.

#### Methods
- `tag(): ?string`
- `setTag(string $tag): self`
- `atts(): ?array`
- `setAtts(array $atts): self`
- `wrapperTag(): ?string`
- `setWrapperTag(string $tag): self`
- `wrapperAtts(): ?array`
- `setWrapperAtts(array $atts): self`
- `atts_str(?array $atts): string`

### `HasMenuIcons`

Provides methods to set and get icons for menu items.

#### Methods
- `setFontAwesomeIcon(string $iconName)`
- `setIconUrl(string $url)`
- `icon(string $classOrIconUrl = ''): string`
- `buildFontAwesomeIconTag(string $className): string`
- `buildImageIconTag(string $class): string`

## Use Cases

### Creating a Menu

```php
use FutzRocket\Menus\Manager;
use FutzRocket\Menus\MenuItem;

$manager = new Manager();
$menu = $manager->createMenu('mainMenu')->menu('mainMenu');

$item1 = new MenuItem(['title' => 'Home', 'url' => '/home']);
$item2 = new MenuItem(['title' => 'About', 'url' => '/about']);

$menu->addItem($item1)->addItem($item2);
```

### Creating a Submenu

```php
use FutzRocket\Menus\SubMenu;
use FutzRocket\Menus\MenuItem;

$submenu = new SubMenu('services', 'Our Services');
$submenu->addItem(new MenuItem(['title' => 'Consulting', 'url' => '/services/consulting']));
$submenu->addItem(new MenuItem(['title' => 'Support', 'url' => '/services/support']));

$menu->addItem($submenu);
```

### Rendering a Menu

```php
use FutzRocket\Menus\Menu;

function render_menu(Menu $menu, bool $return = false)
{
    // Implementation here...
}

render_menu($menu);
```
## Potential Extensions

The FutzRocket Menus Library is designed to be extensible. Here are some ideas for potential extensions:

### Custom Renderers

You can create custom renderers to output menus in different formats, such as JSON, XML, or custom HTML structures. Implementing a custom renderer involves creating a new class that processes the menu structure and outputs the desired format.

### Additional Menu Item Types

Extend the `MenuItem` class to support additional types of menu items, such as dropdowns, separators, or custom components. This can be achieved by subclassing `MenuItem` and adding the necessary properties and methods.

### Integration with Frontend Frameworks

Integrate the library with popular frontend frameworks like React, Vue, or Angular. This could involve creating components that render menus using the data provided by the FutzRocket Menus Library.

### Permission Management

Enhance the permission management system to integrate with popular authentication and authorization libraries. This would allow for more granular control over menu item visibility based on user roles and permissions.

### Dynamic Menus

Implement dynamic menus that can be updated in real-time based on user interactions or external data sources. This could involve using WebSockets or AJAX to fetch and update menu data without reloading the page.

### Theming and Styling

Add support for theming and styling menus using CSS frameworks like Bootstrap or Tailwind CSS. This could involve providing default styles and allowing developers to customize the appearance of menus through configuration options.

These extensions can help tailor the FutzRocket Menus Library to specific project requirements and enhance its functionality.


This README provides an overview of the FutzRocket Menus Library, including its classes, methods, and use cases. For more detailed information, please refer to the source code and inline documentation.