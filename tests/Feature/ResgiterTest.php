<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResgiterTest extends TestCase
{

    public function test_get_validation_error()
    {
        $response = $this->post('/api/Auth/register');

        $response->assertStatus(400);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_save_new_user()
    {
        $response = $this->post('/api/Auth/register', [
            'username' => 'Test User',
            'email' => 'test@example.com',
            'password' => '12345678',
            'phone' => '0185478931',
        ]);
        $response->assertJson(['status'=>1]);
    }
}
