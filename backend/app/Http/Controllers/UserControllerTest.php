<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersWithSkillsAreReturned()
    {

        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'email', 'description'],
        ]);
        $users = $response->json();
        foreach ($users as $user) {
            $this->assertNotEmpty($user['description']);
        }
    }
}
