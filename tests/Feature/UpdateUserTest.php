<?php

namespace Tests\Feature;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Services\UpdateService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
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

    public function test_update()
    {
        $users = User::factory()->count(2)->create(
            [
                'email' => 'aa@aa.com',
            ]);
        $user = $users->last();
        Passport::actingAs($user);

       $response = $this->patch('/api/users/'.$users->first()->id, [
            'email' => "alex@gmail.com",
            'password' => "12345",
            'password_confirmation' => "12345"
        ])->assertStatus(403);

        $user = $users->first();
        Passport::actingAs($user);

        $this->patch('/api/users/'.$user->id, [
            'email' => "asa@aa.aa",
            'password' => "12345",
            'password_confirmation' => "12345"

        ])->assertStatus(202);
        }
}
