<?php

namespace Tests\Unit\Http\Controllers;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class FrontControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEditUser()
    {
        $this->withoutMiddleware();

        $user = \App\Models\User::factory()->create();

        $response = $this->get('/edit-user/1');
        $response->assertSee($user->name);
    }
}
