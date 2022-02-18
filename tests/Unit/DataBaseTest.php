<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataBaseTest extends TestCase
{

    public function testDatabase()
{
     
    $this->assertDatabaseHas('users', [
        'email' => 'asasjksad@asdsad.com'
    ]);
   
}

}
