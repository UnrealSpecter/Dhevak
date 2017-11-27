<?php

use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_media')->insert([
            [
                'name' => 'Facebook',
                'image_url' => 'facebook.jpg'
            ],
            [
                'name' => 'Twitter',
                'image_url' => 'twitter.jpg'
            ],
            [
                'name' => 'Instagram',
                'image_url' => 'instagram.jpg'
            ],
            [
                'name' => 'LinkedIn',
                'image_url' => 'linkedin.jpg'
            ],
            [
                'name' => 'Youtube',
                'image_url' => 'youtube.jpg'
            ]
        ]);

    }
}
