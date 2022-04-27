<?php

namespace Database\Factories;

// use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // protected $model = Post::class;
    
    public function definition()
    {
        return [
            'title' => Str::random(30),
            'category' => 'PHP',
            'body' => $this->faker->text,
            'status'=> 'published', 
            'user'  => $this->faker->name
        ];
    }

}
