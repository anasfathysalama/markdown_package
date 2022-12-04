<?php

namespace Anas\Markdown\Tests\Feature;

use Anas\Markdown\Models\Post;
use Anas\Markdown\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function a_post_create_with_factory()
    {
         $post = factory(Post::class)->create();
         $this->assertCount(1 , Post::all());
    }
}