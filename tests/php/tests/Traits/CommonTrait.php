<?php

declare(strict_types=1);

namespace Tests\Traits;

use Illuminate\Contracts\Console\Kernel;

Trait CommonTrait
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://domanamon.dev';
    protected $defaultEmailAddress = 'john@grandadevans.com';
    protected $loginPage = '/login';
    protected $domainPage = '/domains';


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();


        return $app;
    }


    public  function findAPossibleModel(string $class) {
        if (!strstr($class, 'makeMeA')) {
            return false;
        }
        $model = str_replace('makeMeA', '', $class);
        $namespace = 'Domanamon\\'.$model;
        if (class_exists($namespace)) {
            return $namespace;
        }
        return new \Exception('Model ' . $namespace . 'not found');
    }


    public  function makeAFactory($namespace, array $overrides = [])
    {
        return factory($namespace)->create($overrides);
    }


    public  function __call($method, $args)
    {
        if ($namespace = $this->findAPossibleModel($method)) {
            return $this->makeAFactory($namespace, $args[0] ?? []);
        }

        return new \Exception('Method ' . $method . ' not found');
    }
}
