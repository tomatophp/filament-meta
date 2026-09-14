<?php

use Filament\Actions\Testing\TestAction;
use TomatoPHP\FilamentMeta\Filament\RelationManager\MetaRelationManager;
use TomatoPHP\FilamentMeta\Models\Meta;
use TomatoPHP\FilamentMeta\Tests\Models\User;
use TomatoPHP\FilamentMeta\Tests\Resources\UserResource\Pages\EditUser;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelMissing;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->owner = User::factory()->create();
});

it('can create meta from the relation manager', function () {
    config()->set('filament-meta.create', true);

    livewire(MetaRelationManager::class, [
        'ownerRecord' => $this->owner,
        'pageClass' => EditUser::class,
    ])
        ->callAction(TestAction::make('create')->table(), data: [
            'key' => 'favorite_color',
            'value' => 'red',
        ])
        ->assertHasNoFormErrors();

    assertDatabaseHas(Meta::class, [
        'model_id' => $this->owner->id,
        'model_type' => User::class,
        'key' => 'favorite_color',
        'value' => json_encode('red'),
    ]);
});

it('hides the create action when meta creation is disabled', function () {
    config()->set('filament-meta.create', false);

    livewire(MetaRelationManager::class, [
        'ownerRecord' => $this->owner,
        'pageClass' => EditUser::class,
    ])->assertActionDoesNotExist(TestAction::make('create')->table());
});

it('validates the meta key', function () {
    config()->set('filament-meta.create', true);

    livewire(MetaRelationManager::class, [
        'ownerRecord' => $this->owner,
        'pageClass' => EditUser::class,
    ])
        ->callAction(TestAction::make('create')->table(), data: [
            'key' => null,
        ])
        ->assertHasFormErrors(['key' => 'required']);
});

it('can edit meta from the relation manager', function () {
    $this->owner->meta('favorite_color', 'red');
    $meta = $this->owner->modelMeta()->where('key', 'favorite_color')->first();

    livewire(MetaRelationManager::class, [
        'ownerRecord' => $this->owner,
        'pageClass' => EditUser::class,
    ])
        ->callAction(TestAction::make('edit')->table($meta), data: [
            'key' => 'favorite_color',
            'value' => 'blue',
        ])
        ->assertHasNoFormErrors();

    expect($meta->refresh()->value)->toBe('blue');
});

it('can delete meta from the relation manager', function () {
    $this->owner->meta('favorite_color', 'red');
    $meta = $this->owner->modelMeta()->where('key', 'favorite_color')->first();

    livewire(MetaRelationManager::class, [
        'ownerRecord' => $this->owner,
        'pageClass' => EditUser::class,
    ])->callAction(TestAction::make('delete')->table($meta));

    assertModelMissing($meta);
});
