<?php

use TomatoPHP\FilamentMeta\Models\Meta;
use TomatoPHP\FilamentMeta\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('can save new keys', function () {
    $user = User::factory()->create();
    $user->meta('key', 'new');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => json_encode('new'),
    ]);
});

it('can update keys', function () {
    $user = User::factory()->create();
    $user->meta('key', 'new');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => json_encode('new'),
    ]);

    $user->meta('key', 'update');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => json_encode('update'),
    ]);
});

it('can update keys to null', function () {
    $user = User::factory()->create();
    $user->meta('key', 'new');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => json_encode('new'),
    ]);

    $user->meta('key', 'null');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => null,
    ]);
});

it('can meta accept array', function () {
    $user = User::factory()->create();
    $user->meta('key', [
        'key1' => 'value1',
    ]);

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'value' => json_encode([
            'key1' => 'value1',
        ]),
    ]);
});

it('can meta accept type', function () {
    $user = User::factory()->create();
    $user->meta('key', 'new', 'key-value');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'key_value' => 'new',
    ]);
});

it('can meta accept date', function () {
    $user = User::factory()->create();
    $date = now()->toDateString();
    $user->meta('key', 'new', 'key-value', $date);

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'key_value' => 'new',
        'date' => $date,
    ]);
});

it('can meta accept time', function () {
    $user = User::factory()->create();
    $date = now()->toDateString();
    $time = now()->toTimeString();
    $user->meta('key', 'new', 'key-value', $date, $time);

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'key_value' => 'new',
        'date' => $date,
        'time' => $time,
    ]);
});

it('can meta accept response', function () {
    $user = User::factory()->create();
    $date = now()->toDateString();
    $time = now()->toTimeString();
    $user->meta('key', 'new', 'key-value', $date, $time, 'ok');

    assertDatabaseHas(Meta::class, [
        'model_id' => $user->id,
        'model_type' => User::class,
        'key' => 'key',
        'key_value' => 'new',
        'date' => $date,
        'time' => $time,
        'response' => 'ok',
    ]);
});

it('can use meta() fn', function () {
    meta('key', 'new');

    assertDatabaseHas(Meta::class, [
        'key' => 'key',
        'key_value' => json_decode('new'),
    ]);
});
