<?php


use Dvlpp\Privat\PrivatMiddleware;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->register(\Dvlpp\Privat\PrivatServiceProvider::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $app->make(Illuminate\Contracts\Http\Kernel::class)->pushMiddleware(
            PrivatMiddleware::class
        );

        $app['config']->set('app.key', str_random(32));

        return $app;
    }

}