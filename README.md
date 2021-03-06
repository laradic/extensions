Laradic Laravel Extensions
===============================

## Version 0.1

Laravel extensions work like addons. By default it scans the `extensions` directory for package directories containing a `extension.php` file.
An extension can depend on other extensions. 
  
- **Optional** Uses [laradic/themes](https://github.com/laradic/themes) for handling themes.
- **Optional** Uses [laradic/config](https://github.com/laradic/config) for handling config.

Using themes and config will pretty much make using extensions using the namespace, an example:

```php
$extension      = Extensions::get('laradic/admin');
$view           = View::get('laradic/admin:view.path');
$configKeyValue = Config::get('laradic/admin:config.key');

# Save the altered config to file or db
Config::getLoader()->set('laradic/admin:config.key', 'value');

```

#### Example extension
Check [laradic/admin](https://github.com/laradic/admin) or [laradic/docit](https://github.com/laradic/docit) for a working implementation.
  
###### Directory structure
```xml
- app
- bootstrap
- extensions
    - vendor
        - package
            - resources
                - config
                - migrations
                - seeds
                - theme
                    - assets
                    - views
            - src
                - PackageServiceProvider.php
            - composer.json
            - MyExtension.php
- vendor
```

###### MyExtension.php
```php
namespace Vendor\My;

use Illuminate\Contracts\Foundation\Application;
use Laradic\Extensions\Extension;
use Laradic\Extensions\ExtensionCollection;

class MyExtension extends Extension
{

    protected $version = '1.0.0';

    protected $dependencies = [
        'vendor/extension1'
    ];

    protected $provides = [ ];

    public static function getInfo()
    {
        return [
            'name'        => 'My Extension',
            'slug'        => 'vendor/my',
            'description' => 'A ext',
            'author'      => 'me'
        ];
    }


    public function boot()
    {

    }

    public function register()
    {

    }

}
```
  
- `register` is always called
- `boot` is called only if the extension is installed
- `install` and `uninstall` are called on installation and uninstall.


#### Commands
```sh
# Shows an overview of all extensions
php artisan extensions:list 

# Install an extension
php artisan extensions:install vendor/package
 
# Uninstall an extension
php artisan extensions:uninstall vendor/package 

# Create an extension
php artisan extensions:create vendor/package [extensions-path] 
```

#### General class methods
Check out the API documentation for a complete overview.
  
| Method | Description |
|--------|-------------|
| **ExtensionFactory** | [API doc](http://doc.no.nl) |
| `Extensions::get('vendor/package')` | Returns the `Extension` instance |
| `Extensions::has('vendor/package')` | Returns `bool` |
| `Extensions::all()` | Returns a sorted by dependency `array` containing `Extension` instances |
| `Extensions::addPath($path)` | Adds a path to search for extensions (like the `extensions` directory) |
| `Extensions::locateAndRegisterAll()` | Returns `bool` |
| `Extensions::register('vendor/package')` | Returns `bool` |
| `Extensions::sortByDependencies()` | Returns `bool` |
| `Extensions::createFromFile('vendor/package')` | Returns `bool` |
| `Extensions::has('vendor/package')` | Returns `bool` |
| `Extensions::has('vendor/package')` | Returns `bool` |
| **Extension** | [API doc](http://doc.no.nl) |
| `$extension->isInstalled()` | Returns `bool` |
| `$extension->install()` | Installs the extension |
| `$extension->uninstall()` | Uninstalls the extension |
| `$extension->canInstall()` | Returns `bool`, checks if the dependencies for this extension are installed |
| `$extension->canUninstall()` | Returns `bool`, checks if other installed extensions depend on this extension |
| `$extension->getDependencies()` | Returns `array` |
| `$extension->getSlug()` | Returns `string` |
| `$extension->getName()` | Returns `string` |
| `$extension->getProperties()` | Returns the `extension.php` `array`, can be accessed using `$extension['dot.notation.key']` aswell |

#### Events
- `extension.installing`
- `extension.installed`
- `extension.uninstalling`
- `extension.uninstalled`
- `extension.registering`
- `extension.registered`
- `extension.booting`
- `extension.booted`

#### Config
```php
return array(
    'paths' => array(
        base_path('extensions')
    )
);
```
