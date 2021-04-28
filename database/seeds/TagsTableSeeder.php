<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 20)->create();

        $tags = App\Tag::all();

        (App\Post::all())->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 6))->pluck('id')->toArray()
            );
        });
    }
}
