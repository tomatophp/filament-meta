<?php

namespace TomatoPHP\FilamentMeta\Tests\Resources\UserResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use TomatoPHP\FilamentMeta\Tests\Resources\UserResource;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;
}
