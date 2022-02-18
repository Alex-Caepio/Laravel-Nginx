<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DataBaseTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');

        $data = ['email'=>'asasjksad@asdsad.com',
                'password'=>123456789
    ];

        $user = User::create($data);
    }

    public function testDatabase()
    {
     
    $this->assertDatabaseHas('users', [
        'email' => 'asasjksad@asdsad.com'
    ]);
   
}

}
