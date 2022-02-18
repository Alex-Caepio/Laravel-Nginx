<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public $userService;

    /*protected function setUp():void{
        $this->userService = new UserService; 
    } 
    
    protected function tiarDown(): void{
        $this->userService = null;
    }*/
    public function test_example1()
    {
        $this->assertClassHasAttribute('token', UserService::class);
    }
   
}
