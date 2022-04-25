<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_seeder_works()
    {
    //     $response = $this->get('/posts');
    //    $this->assertTrue(true);
           $this->seed();
    }
}
