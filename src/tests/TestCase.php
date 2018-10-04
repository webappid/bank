<?php
/**
 * @author Dyan Galih <dyan.galih@gmail.com>
 * @copyright 2018 WebAppId
 */
namespace WebAppId\Bank\Tests;

use Faker\Factory as Faker;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $faker;
    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create('id_ID');
        $this->loadMigrationsFrom([
            '--realpath' => realpath(__DIR__ . '/../src/migrations'),
        ]);
        $this->artisan('webappid:bank:seed');
    }
    protected function getPackageProviders($app)
    {
        return [
            \WebAppId\Bank\ServiceProvider::class,
        ];
    }
    protected function getPackageAliases($app)
    {
        return [
            'Bank' => \WebAppId\Bank\Facade::class,
        ];
    }
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
