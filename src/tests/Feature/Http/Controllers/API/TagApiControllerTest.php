<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TagApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testTagList()
    {
        $this->get('api/v1/tags/list')->assertStatus(200);
    }

    public function testTagStore()
    {
        $this->post('api/v1/tags/create', [
            'name' => 'Test',
        ])->assertStatus(200);
    }

    public function testTagDelete()
    {
        $this->post('api/v1/tags/create', [
            'name' => 'Test',
        ]);

        $tag = Tag::query()->first();
        $this->delete('api/v1/tags/delete/'.$tag->id)->assertStatus(200);
    }

    public function testTagDetails()
    {
        $this->post('api/v1/tags/create', [
            'name' => 'Test',
        ]);

        $tag = Tag::query()->first();
        $this->get('api/v1/tags/details/'.$tag->id)->assertStatus(200);
    }

    public function testTagUpdate()
    {
        $this->post('api/v1/tags/create', [
            'name' => 'Test',
        ]);

        $tag = Tag::query()->first();

        $this->put('api/v1/tags/update/'.$tag->id, [
            'name' => 'Test',
        ])->assertStatus(200);
    }
}
