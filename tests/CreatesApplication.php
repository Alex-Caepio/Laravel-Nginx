<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    protected function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
