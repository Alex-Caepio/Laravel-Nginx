<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UpdateService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PersonTest extends TestCase
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

    public function test_update()
    {
        $users = User::factory()->count(2)->create(
            [
                'email' => 'aa@aa.com',
            ]);
        $user = $users->last();
        Passport::actingAs($user);

        $this->get('/api/users/'.$users->first()->id)->assertStatus(403);

        $user = $users->first();
        Passport::actingAs($user);

        $this->get('/api/users/'.$user->id)->assertStatus(200);
    }
}
