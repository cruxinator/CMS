<?php

namespace Tests;

use Illuminate\View\Compilers\BladeCompiler;
use Orchestra\Testbench\Concerns\WithLaravelMigrations;
use Orchestra\Testbench\Console\Kernel;
use Orchestra\Testbench\Tests\Stubs\Providers\ServiceProvider;
use Tests\Models\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithLaravelMigrations;

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('cms.load-modules', false);
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('minify.config.ignore_environments', ['local', 'testing']);
        $app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');


        $app['Illuminate\Contracts\Auth\Access\Gate']->define('cms', function ($user) {
            return true;
        });
    }

    /**
     * getPackageProviders.
     *
     * @param App $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Grafite\Cms\GrafiteCmsProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            \Grafite\Builder\GrafiteBuilderProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Form' => \Collective\Html\FormFacade::class,
            'HTML' => \Collective\Html\HtmlFacade::class,
            'FormMaker' => \Grafite\Builder\Facades\FormMaker::class,
            'InputMaker' => \Grafite\Builder\Facades\InputMaker::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/factories');

        $this->artisan('vendor:publish', [
            '--provider' => 'Grafite\Cms\GrafiteCmsProvider',
            '--force' => true,
        ]);

        config(['cms.user-model' => User::class]);
        $this->loadLaravelMigrations('testbench');
        $this->artisan('migrate', [
            '--database' => 'testbench',
        ]);
        $this->withoutMiddleware();
        $this->withoutEvents();
    }

    /**
     * Resolve application Console Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Console\Kernel', Kernel::class);
        $app->singleton('blade.compiler', function () use ($app) {
            return new BladeCompiler(
                $app['files'],
                $app['config']['view.compiled']
            );
        });

        $app->instance('path', $app->path());
        $app->instance('path.base', $app->basePath());
        $app->instance('path.lang', $app->langPath());
        $app->instance('path.config', $app->configPath());
        $app->instance('path.public', $app->publicPath());
        $app->instance('path.storage', $app->storagePath());
        $app->instance('path.database', $app->databasePath());
        $app->instance('path.resources', $app->resourcePath());
        $app->instance('path.bootstrap', $app->bootstrapPath());
    }
}
