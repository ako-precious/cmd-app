<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
 
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
      use  RefreshDatabase;
      use WithoutMiddleware;

    protected $user;

    public function setUp():void{
        parent::setUp(); 
        
        $this->user = Sanctum::actingAs(User::factory()->create(),
    ['*']
);
        // $this->actingAs($this->user, 'sanctum');
        
    }
    public function test_posts_create()
    {
        $postForm=[
        'title' => 'What is html',
        'category' => 'HTML' ,
        'body' => 'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It can be assisted by technologies such as Cascading Style Sheets and scripting languages such as JavaScript' ,
        'status' => 'published',
        'user'  => 'john',
        'user_id'  => auth()->id(),
        ];
        $response =  $this->json('POST',route('posts.store'), $postForm);
        $response->assertStatus(201);        
    }
    
    public function test_posts_show(){
        
        $this->withoutExceptionHandling();
        $post = Post::factory()->make();
        $this->user->posts()->save($post);
        
        $token = Auth::user()->createToken('nfce_client')->accessToken;
        // $token = $this->user->createToken('myapptoken')->plainTextToken;
        $headers = ['Accept' => 'application/json','Authorization' => "Bearer $token"];
        $this->get(route('posts.show',$post->id), $headers)->assertStatus(200);
    }

    public function test_posts_update(){

        $this->withoutExceptionHandling();
          $post = Post::factory()->make();
          $this->user->posts()->save($post);
          $postForm=[
        'title' => 'What is html',
        'category' => 'HTML' ,
        'body' => 'The HyperText Markup Language or HTML is the standard markup language for documents designed to be displayed in a web browser. It can be assisted by technologies such as Cascading Style Sheets and scripting languages such as JavaScript' ,
        'status' => 'published',
        'user'  =>    'ako',
        'user_id'  => auth()->id(),
        ];
        $this->json('PUT', route('posts.update', $post->id), $postForm)
        ->assertStatus(200);
    }
    public function test_posts_delete(){
                
        $post = Post::factory()->make();
        $this->user->posts()->save($post);
        $this->delete( route('posts.destroy', $post->id))
        ->assertStatus(200);
        }
        
    public function test_posts_list(){
                
        $posts = Post::factory(5)->make();
        $this->user->posts()->saveMany($posts);
        $this->get( route('posts.index'))
        ->assertStatus(200);
        }

        
    
}
