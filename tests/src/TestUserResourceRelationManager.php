<?php

use TomatoPHP\FilamentMeta\Tests\Models\User;
use TomatoPHP\FilamentMeta\Tests\Resources\UserResource;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('can render user resource', function () {
    get(UserResource::getUrl())->assertOk();
});

it('can render edit user resource', function () {
    $user = User::factory()->create();

    get(UserResource::getUrl('edit', ['record' => $user]))->assertOk();
});

it('can render relation manager', function () {
    $user = User::factory()->create();

    livewire(\TomatoPHP\FilamentMeta\Filament\RelationManager\MetaRelationManager::class, [
        'ownerRecord' => $user,
        'pageClass' => UserResource\Pages\EditUser::class,
    ])->assertSuccessful();
});

it('can list meta', function () {
    $user = User::factory()->create();
    $user->meta('test', 'welcome');

    livewire(\TomatoPHP\FilamentMeta\Filament\RelationManager\MetaRelationManager::class, [
        'ownerRecord' => $user,
        'pageClass' => UserResource\Pages\EditUser::class,
    ])->assertCanSeeTableRecords($user->modelMeta);
});
