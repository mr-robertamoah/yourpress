<?php

namespace Tests\Feature;

use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ApiTest extends TestCase
{
    // use RefreshDatabase;

    protected function setup(): void
    {
        parent::setUp();

        DB::table('users')->truncate();
    }
    
    public function test_throws_exception_when_username_and_email_are_null()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid');

        $this->withoutExceptionHandling();

        $data = [
            'username' => null,
            'email' => null,
            'password' => 'password'
        ];

        $response = $this->post('/api/login', $data);
    }
    
    public function test_throws_exception_when_username_or_email_and_password_doesnt_match()
    {
        User::factory()->state([
            'username' => 'mr_robertamoah',
            'email' => 'mr_robertamoah@yahoo.com',
        ])->create();

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("username/email and password combination provided could not be found 😕");

        $this->withoutExceptionHandling();

        $data = [
            'username' => null,
            'email' => 'mr_robertamoah@yahoo.com',
            'password' => 'password123'
        ];

        $response = $this->post('/api/login', $data);
    }
    
    public function test_throws_exception_when_username_or_email_doesnt_exist()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid');

        // $this->withoutExceptionHandling();

        $data = [
            'username' => null,
            'email' => 'mr_robert@yahoo.com',
            'password' => 'password'
        ];

        $response = $this->post('/api/login', $data);
        $response->assertJson([
            'message' => 'The given data was invalid',
            'errors' => [
                'email' => "the email does not exist"
            ]
        ]);
    }
    
    public function test_that_login_is_successful()
    {
        $this->withoutExceptionHandling();

        User::factory()->state([
            'username' => 'mr_robertamoah',
            'email' => 'mr_robertamoah@yahoo.com',
        ])->create();

        $data = [
            'username' => null,
            'email' => 'mr_robertamoah@yahoo.com',
            'password' => 'password'
        ];

        $response = $this->post('/api/login', $data);

        $response->assertSuccessful()
            ->assertJsonStructure(['message','user']);
    }
}
