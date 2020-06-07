<?php
/**
 * Created by PhpStorm.
 */

namespace WebAppId\DDD\Traits;

use Faker\Factory as Faker;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use WebAppId\User\Models\User;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 06/06/2020
 * Time: 15.57
 * Class TestCaseTrait
 * @package WebAppId\User\Tests
 */
trait TestCaseTrait
{
    private $faker;

    /**
     * @var Container
     */
    protected $container;

    protected function getFaker()
    {
        if ($this->faker == null) {
            $this->faker = new Faker;
        }

        return $this->faker->create('id_ID');
    }

    public function tearDown():void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', User::class );
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom([
            '--realpath' => realpath(__DIR__ . './src/migrations'),
        ]);
    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->container = new Container();
        parent::__construct($name, $data, $dataName);
    }

    protected function secure()
    {
        $user = new User;
        $user = $user->find('1');
        if ($user != null) {
            $this->be($user);
        } else {
            dd('please add user with id 1 to run this unit test');
        }
        return $user;
    }

    protected function sendToLog(string $serviceName, string $endpoint, array $data)
    {
        error_log('==========================================================');
        error_log('Service Name : ' . $serviceName);
        error_log('Endpoint : ' . $endpoint);
        error_log('Payload : ' . json_encode($data));
    }

    protected function resultLog(string $result){
        error_log('==========================================================');
        error_log('Sample Result : ' . $result);
        error_log('==========================================================');
    }

    /**
     * Resolve application HTTP Kernel implementation.
     *
     * @param Application $app
     * @return void
     */
    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'WebAppId\DDD\Kernel\Http\Kernel');
    }
}