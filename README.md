![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-meta/master/arts/3x1io-tomato-meta.jpg)

# Filament Meta Manager

[![Tests](https://github.com/tomatophp/filament-meta/actions/workflows/tests.yml/badge.svg)](https://github.com/tomatophp/filament-meta/actions/workflows/tests.yml)
[![PHP Code Styling](https://github.com/tomatophp/filament-meta/actions/workflows/fix-php-code-styling.yml/badge.svg)](https://github.com/tomatophp/filament-meta/actions/workflows/fix-php-code-styling.yml)
[![Dependabot Updates](https://github.com/tomatophp/filament-meta/actions/workflows/dependabot/dependabot-updates/badge.svg)](https://github.com/tomatophp/filament-meta/actions/workflows/dependabot/dependabot-updates)
[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-meta/version.svg)](https://packagist.org/packages/tomatophp/filament-meta)
[![License](https://poser.pugx.org/tomatophp/filament-meta/license.svg)](https://packagist.org/packages/tomatophp/filament-meta)
[![Downloads](https://poser.pugx.org/tomatophp/filament-meta/d/total.svg)](https://packagist.org/packages/tomatophp/filament-meta)

Convert any model on your app to pluggable model using Meta and get ready to use relation manager on FilamentPHP panel

## Screenshots


![Relation Manager](https://raw.githubusercontent.com/tomatophp/filament-meta/master/arts/relation-manager.png)
![Create](https://raw.githubusercontent.com/tomatophp/filament-meta/master/arts/create.png)
![Edit](https://raw.githubusercontent.com/tomatophp/filament-meta/master/arts/edit.png)
## Installation

```bash
composer require tomatophp/filament-meta
```
after install your package please run this command

```bash
php artisan filament-meta:install
```

on your model you want to use meta on it, just add this trait

```php
use Tomatophp\FilamentMeta\Traits\HasMeta;

class  User extends Model
{
    use HasMeta;
}
```

now on your Resource you can add meta relation manager like this

```php

use Tomatophp\FilamentMeta\Filament\RelationManager\MetaRelationManager;

public static function getRelations(): array
{
    return [
        MetaRelationManager::class
    ];
}
```

## Usage

meta trait add `->meta()` method to your model that you can use to get meta data

```php
$user = User::find(1);
$user->meta('key');
```

if the key not exists it will create it for you, if you like to set data it's very easy

```php
$user = User::find(1);
$user->meta('key', 'value');
```

if you like to set data null to selected key just pass null as value

```php
$user = User::find(1);
$user->meta('key', 'null');
```

the meta accepts array as value

```php
$user = User::find(1);
$user->meta('key', ['value' => 'value']);
```

## Disable Create New meta

publish your config using this command

```bash
php artisan vendor:publish --tag="filament-meta-config"
```

then go to `config/filament-meta.php` and set `create` to `false`

```php
return [
    'create' => false
];
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

## Testing

if you like to run `PEST` testing just use this command

```bash
composer test
```

## Code Style

if you like to fix the code style just use this command

```bash
composer format
```

## PHPStan

if you like to check the code by `PHPStan` just use this command

```bash
composer analyse
```

## Other Filament Packages

Checkout our [Awesome TomatoPHP](https://github.com/tomatophp/awesome)
