<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
 
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
      use  RefreshDatabase;

    protected $user;

    public function setUp():void{
        parent::setUp(); 
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');
        
    }
    public function test_categories_create()
    {
        $categoryForm=[
        'category_name' => 'HTML' ,
        ];
        $this->withoutExceptionHandling();
        $response =  $this->json('POST',route('categories.store'), $categoryForm);
        $response->assertStatus(201);        
    }

    public function test_categories_show(){
    
        $category = Category::factory()->make();
        $this->get(route('categories.show', [
        'id' => $category->id,
        ]))->assertStatus(200);
    }

    public function test_categories_update(){

        $this->withoutExceptionHandling();
        $category = Category::factory()->make();
        $categoryForm=[
        'category_name' => 'HTML' ,
        ];
        $this->json('PUT', route('categories.show', [
        'id' => $category->id,
        ]), $categoryForm)
        ->assertStatus(200);
    }
    public function test_categories_delete(){
                
        $category = Category::factory()->make();
        $this->delete( route('categories.destroy',['id' => $category->id], ))
        ->assertStatus(200);
        }
        
    public function test_categories_list(){
        $categories = Category::factory(5)->make();
        $this->get( route('categories.index'))
        ->assertStatus(200);
        }

        
    
}
