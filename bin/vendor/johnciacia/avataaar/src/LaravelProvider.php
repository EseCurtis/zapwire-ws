<?php

namespace Avataaar;

use Faker\Factory;
use Faker\Generator;

/**
 *
 */
class LaravelProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerProvider($faker));
            return $faker;
        });
    }
}
