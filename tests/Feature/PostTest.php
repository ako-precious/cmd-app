<?php

namespace Tests\Feature;

use App\Models\User;
 
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
      use  WithFaker, RefreshDatabase;
    public function test_posts_view()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum');
        $postForm=[
        'title' => 'What is html',
        'category' => 'HTML' ,
        'body' => 'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It can be assisted by technologies such as Cascading Style Sheets and scripting languages such as JavaScript' ,
        'status' => 'published',
        'user'  => 'john'
        ];

        $this->withoutExceptionHandling();
        $response = $this->json('POST',route('posts.store'), $postForm);

        $response->assertStatus(201);
    }
}
