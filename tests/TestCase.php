<?php

namespace Tests;

use Exception;
use Faker\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use SoftDeletes;

    private $faker;

    public function setUp()
    : void {

        parent::setUp();
        $this->faker = Factory::create();
        Artisan::call('migrate:fresh');
    }
    public function __get($key) {
        if ($key === 'faker')
            return $this->faker;
        throw new Exception('Unknown Key Requested');
    }
}
