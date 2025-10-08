![Screenshot](https://raw.githubusercontent.com/tomatophp/filament-meta/master/arts/fadymondy-tomato-meta.jpg)

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
$user->meta(key: 'key',value: 'value');
```

if you like to set data null to selected key just pass null as value

```php
$user = User::find(1);
$user->meta(key: 'key',value: 'null');
```

the meta accepts array as value

```php
$user = User::find(1);
$user->meta(key:'key',value: ['value' => 'value']);
```

you can set a type for any meta like this 

```php
$user = User::find(1);
$user->meta(key:'key',value: ['value' => 'value'], type: 'json');
```

if you like to make the value just string without json input to be indexed you can use `key-value` type

```php
$user = User::find(1);
$user->meta(key:'key',value: ['value' => 'value'], type: 'key-value');
```

then your data will be saved to column `key_value` not in `value` column

you can make a time series of meta by set a date and time on your meta

```php
$user = User::find(1);
$user->meta(key:'key',value: ['value' => 'value'], date: '2023-10-01', time: '12:00:00');
```

if you use the meta for api response or save form data you can have a `response` and it can be anything you like be default it's `ok`

```php
$user = User::find(1);
$user->meta(key:'key',value: ['value' => 'value'], response: 'ok');
```

## Use Global Hepler

you can use Meta without any users or models, just use this helper

```php
meta(key: 'key',value: 'value');
```

it will return the value of the key if exists, otherwise it will create it for you

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
