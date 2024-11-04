<?php

namespace TomatoPHP\FilamentMeta\Tests\Resources\UserResource\Pages;

use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentMeta\Tests\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
}
