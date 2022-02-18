<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{

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
