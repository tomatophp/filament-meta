<?php

namespace TomatoPHP\FilamentMeta\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Attributes\WithEnv;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as BaseTestCase;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use TomatoPHP\FilamentMeta\FilamentMetaServiceProvider;
use TomatoPHP\FilamentUsers\Tests\Models\User;

#[WithEnv('DB_CONNECTION', 'testing')]
abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        $provider = [
            ActionsServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            LivewireServiceProvider::class,
            NotificationsServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            SchemasServiceProvider::class,
            WidgetsServiceProvider::class,
            FilamentMetaServiceProvider::class,
            AdminPanelProvider::class,
        ];

        sort($provider);

        return $provider;
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    public function getEnvironmentSetUp($app): void
    {

        $app['config']->set('database.default', 'testing');
        $app['config']->set('auth.guards.testing.driver', 'session');
        $app['config']->set('auth.guards.testing.provider', 'testing');
        $app['config']->set('auth.providers.testing.driver', 'eloquent');
        $app['config']->set('auth.providers.testing.model', User::class);

        $app['config']->set('view.paths', [
            ...$app['config']->get('view.paths'),
            __DIR__ . '/../resources/views',
        ]);
    }
}
