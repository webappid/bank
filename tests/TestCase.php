<?php
/**
 * @author Dyan Galih <dyan.galih@gmail.com>
 * @copyright 2018 WebAppId
 */
namespace WebAppId\Bank\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use WebAppId\Bank\ServiceProvider;
use WebAppId\DDD\Traits\TestCaseTrait;

abstract class TestCase extends BaseTestCase
{
    use TestCaseTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom([
            '--realpath' => realpath(__DIR__ . './src/migrations'),
        ]);
        $this->artisan('webappid:bank:seed');
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }
}
