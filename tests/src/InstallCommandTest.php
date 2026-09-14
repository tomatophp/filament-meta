<?php

use Illuminate\Support\Facades\Schema;

it('runs the install command', function () {
    $this->artisan('filament-meta:install')
        ->expectsOutput('Filament Meta installed successfully.')
        ->assertSuccessful();

    expect(Schema::hasTable('metas'))->toBeTrue();
});
