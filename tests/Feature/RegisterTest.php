<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;
    
    protected function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }
    public function testRegistration()
    {
        $response = $this->post('/api/users', [
            'email' => "kssfpdf@frtw.com",
            'password' => "123456789",
            'password_confirmation' => "123456789"
        ]);
            
        $response->assertStatus(201);
    }
}
