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
        $registrationData = [
            'email' => "kssfpdf@frtw.com",
            'password' => "123456789",
            'password_confirmation' => "123456789"
        ];
        $response = $this->post('/api/users', $registrationData)->assertStatus(201);
            
        $registrationDatabase = [
            'email' => "kssfpdf@frtw.com",
            'password' => "123456789",
            'password_confirmation' => "12345678"
        ];

        $response = $this->post('/api/users', $registrationDatabase)->assertStatus(302);
                    
    }

    
}
