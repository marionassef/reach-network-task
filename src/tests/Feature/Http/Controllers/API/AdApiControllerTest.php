<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Ad;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AdApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function testAdList()
    {
        $ad = Ad::query()->first();
        $this->get('api/v1/ads/list/'.$ad->id)->assertStatus(200);
    }

    public function testAdListWithCategory()
    {
        $ad = Ad::query()->first();
        $this->get('api/v1/ads/list/'.$ad->id.'?category='.$ad->category->name)->assertStatus(200);
    }

    public function testAdListWithCategoryAndTags()
    {
        $ad = Ad::query()->first();
        $this->get('api/v1/ads/list/'.$ad->id.'?category='.$ad->category->name.'&tag='.$ad->tags->first()->name)->assertStatus(200);
    }
}
