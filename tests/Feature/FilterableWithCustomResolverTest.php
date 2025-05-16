<?php

use Refinephp\LaravelRefine\Tests\App\Models\Post;
use Refinephp\LaravelRefine\Tests\App\Models\Tag;
use Refinephp\LaravelRefine\Tests\TestCase;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\assertEquals;

class FilterableWithCustomResolverTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::get('/tags', function () {
            return Tag::with('posts')->filter()->get();
        });

        Tag::create([
            'name' => 'laravel',
        ])
            ->posts()->create([
                'title' => 'laravel is the best',
            ]);

        Tag::create([
            'name' => 'laravel-refine',
        ])->posts()->create([
            'title' => 'refine is great',
        ]);

        Tag::create([
            'name' => 'refine_tag',
        ]);
    }

    /** @test */
    public function it_can_process_a_basic_request_without_any_filter(): void
    {
        $response = $this->getJson('/tags');

        $response->assertOk();
        $response->assertJsonCount(3);
    }

    /** @test */
    public function it_can_process_a_request_without_any_matches(): void
    {
        $response = $this->getJson('/tags?filters[name][$eq]=nothing');

        $response->assertOk();
        $response->assertJsonCount(0);
    }

    /** @test */
    public function it_can_filter_with_a_basic_eq_operator(): void
    {
        $response = $this->getJson('/tags?filters[name][$eq]=laravel');

        $response->assertOk();
        $response->assertJsonCount(1);
    }

    /** @test */
    public function it_can_process_custom_operator1(): void
    {
        $response = $this->getJson('/tags?filters[name][$refine]=true');

        $response->assertOk();
        $response->assertJsonCount(1); // since we have 1 tag with name 'refine_tag'
    }

    /** @test */
    public function it_can_process_with_grouped_filters()
    {
        $post = Post::query()->create(['title' => 'title']);
        $tag = Tag::query()->create(['name' => 'tag']);
        $post->tags()->save($tag);

        $response = $this->getJson('/tags?filters[$or][0][name][$eq]=tag&filters[posts][title][$eq]=title');
        $response
            ->assertOk()
            ->assertJsonCount(1);

        assertEquals('tag', $response->json()[0]['name']);
    }
}
