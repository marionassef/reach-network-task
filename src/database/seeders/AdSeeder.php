<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Tag::factory()->count(10)->create();

        DB::table('ads')->insert([
            'title' => Str::slug(Str::random(10)),
            'description' => Str::random(30),
            'type' => 'FREE',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'start_date' => date('Y-m-d', strtotime(date('Y-m-d') .'+1 day')),
            'end_date' => date('Y-m-d', strtotime(date('Y-m-d') .'+10 day')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $ad = Ad::query()->first();
        $tags = Tag::all()->random(5);
        foreach ($tags as $tag){
            DB::table('ad_tag')->insert([
                'ad_id' => $ad->id,
                'tag_id' => $tag->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
