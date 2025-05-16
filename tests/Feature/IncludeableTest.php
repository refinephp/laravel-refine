<?php

use Refinephp\LaravelRefine\Tests\App\Models\Post;
use Refinephp\LaravelRefine\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\assertTrue;

class IncludeableTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Post::create([
            'title' => 'refine is great',
        ])->comments()->create([
            'content' => 'refine is great',
        ]);
        Post::create([
            'title' => 'refine is great',
        ])->comments()->create([
            'content' => 'refine is great',
        ]);
        Post::create([
            'title' => 'refine is great',
        ])->comments()->create([
            'content' => 'refine is great',
        ]);

        Route::get('/posts', function () {
            return Post::WithIncludes()->get();;
        });
    }

    /** @test */
    public function it_includes_specified_relationships(): void
    {
        $response = $this->getJson("/posts?includes=comment");
        assertTrue($response->collect()->pluck('comments')->isNotEmpty());
    }
}
