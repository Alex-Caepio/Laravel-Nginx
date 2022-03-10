<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UpdateService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GateUpdateTest extends TestCase
{
    use DatabaseMigrations;

    protected $userService;


    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('passport:install');

        $this->userService = $this->app->make(UpdateService::class);

    }
    public function test_gate_update()
    {
        $users = User::factory()->count(2)->create(
            [
                'email' => 'aa@aa.com',

            ]);
        $user = $users->last();
        Passport::actingAs($user);

        $this->userService->updateAuth($user, [
            'email' => "alex@gmail.com",
            'password' => "12345",
            'password_confirmation' => "12345"
        ]);
        $this->assertDatabaseHas('users',[
            'email' => "alex@gmail.com",
        ]);
    }
}
