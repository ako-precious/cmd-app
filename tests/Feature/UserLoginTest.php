<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\RequestGuard;
use Laravel\Sanctum\Sanctum;
class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use  RefreshDatabase;
    public function testRequireEmailAndLogin()
    {
        $this->json('POST', 'api/v1/login')
            ->assertStatus(422)                
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
                        
    }

    public function testUserLoginSuccessfully()
    {
        User::create([
        'name' => 'test',
        'email'=>'test@gmail.com',
        'password' => bcrypt('secret1234')
    ]);
    $response = $this->json('POST', 'api/v1/login',[
        'email' => 'test@gmail.com',
        'password' => 'secret1234',
    ]);
    $response->assertStatus(201);
    }
    
    public function testLogoutSuccessfully()
    {
    $user =  User::create([
        'name' => 'test',
        'email'=>'test@gmail.com',
        'password' => bcrypt('secret1234')
    ]);
        Auth::attempt([
        'email' => 'test@gmail.com',
        'password' => 'secret1234',
    ]);
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('POST', 'api/v1/logout', [], $headers)
            ->assertStatus(200);
    }

    public function test_Post_list_can_be_retrieved()
{
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );
 
    $response = $this->get('api/v1/posts');
 
    $response->assertOk();
}
}
