<?php

namespace TomatoPHP\FilamentMeta;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentMetaPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-meta';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): self
    {
        return new FilamentMetaPlugin;
    }
}
