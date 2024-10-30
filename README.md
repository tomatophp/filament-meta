![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-meta/master/art/screenshot.jpg)

# Filament meta

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-meta/version.svg)](https://packagist.org/packages/tomatophp/filament-meta)
[![License](https://poser.pugx.org/tomatophp/filament-meta/license.svg)](https://packagist.org/packages/tomatophp/filament-meta)
[![Downloads](https://poser.pugx.org/tomatophp/filament-meta/d/total.svg)](https://packagist.org/packages/tomatophp/filament-meta)

Convert any model on your app to pluggable model using Meta and get ready to use relation manager on FilamentPHP panel

## Installation

```bash
composer require tomatophp/filament-meta
```
after install your package please run this command

```bash
php artisan filament-meta:install
```

finally register the plugin on `/app/Providers/Filament/AdminPanelProvider.php`

```php
->plugin(\TomatoPHP\FilamentMeta\FilamentMetaPlugin::make())
```


## Publish Assets

you can publish config file by use this command

```bash
php artisan vendor:publish --tag="filament-meta-config"
```

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-meta-views"
```

you can publish languages file by use this command

```bash
php artisan vendor:publish --tag="filament-meta-lang"
```

you can publish migrations file by use this command

```bash
php artisan vendor:publish --tag="filament-meta-migrations"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
