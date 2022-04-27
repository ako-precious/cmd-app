<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


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
        
        $user = User::factory()->create();
                
        $this->json('POST', 'api/v1/login', [
                'email' => $user->email,
                'password' => 'textpass'])
            ->assertStatus(200);
    }
    
    public function testLogoutSuccessfully()
    {
       $user = ['email' => 'user@test.com', 'password' => 'textpass'];
        
        Auth::attempt($user);
        $accessToken = auth()->user()->token();
$token= $request->user()->tokens->find($accessToken);
$token->revoke();
        $this->json('GET', 'api/v1/logout')
            ->assertStatus(204);
    }
}
