<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCategoryList()
    {
        $this->get('api/v1/categories/list')->assertStatus(200);
    }

    public function testCategoryStore()
    {
        $this->withoutExceptionHandling()->post('api/v1/categories/create', [
            'name' => 'Test',
        ])->assertStatus(200);
    }

    public function testCategoryDelete()
    {
        $this->post('api/v1/categories/create', [
            'name' => 'Test',
        ]);

        $category = Category::query()->first();
        $this->delete('api/v1/categories/delete/'.$category->id)->assertStatus(200);
    }

    public function testCategoryDetails()
    {
        $this->post('api/v1/categories/create', [
            'name' => 'Test',
        ]);

        $category = Category::query()->first();
        $this->get('api/v1/categories/details/'.$category->id)->assertStatus(200);
    }

    public function testCategoryUpdate()
    {
        $this->post('api/v1/categories/create', [
            'name' => 'Test',
        ]);

        $category = Category::query()->first();

        $this->put('api/v1/categories/update/'.$category->id, [
            'name' => 'Test',
        ])->assertStatus(200);
    }
}
