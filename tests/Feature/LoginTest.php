<?php

namespace Tests\Feature;

use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');
    }
    public function testLogin()
    {
        $user = User::create([
            'email' => "asa@aa.aa",
            'password' => Hash::make("123456789")
        ]);

        $response = $this->post('/api/login', [
            'email' => "asa@aa.aa",
            'password' => "123456789"
        ])->assertStatus(200)
        ->assertJsonStructure(['token']);

        $this->assertAuthenticatedAs($user);

        $response = $this->post('/api/login', [
            'email' => "asa@aa.aa",
            'password' => "1234567"
        ])->assertStatus(422);

    }
}
