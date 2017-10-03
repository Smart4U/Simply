<?php

use Phinx\Seed\AbstractSeed;

/**
 * Class SeedPostTable
 */
class SeedPostTable extends AbstractSeed
{


    public function run()
    {
        $faker = \Faker\Factory::create();

        /** ### Categories Seed ### */
        $categories  = [];
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence(1);
            $categories[] = [
                'title' => $title,
                'slug' => str_replace(' ', '-', strtolower(trim($title, '.')))
            ];
        }
        $this->insert('categories', $categories);
        /** ### End Categories Seed ### */


        /** ### Posts Seed ### */
        $posts  = [];
        $categories = array_map( // Select categories for the foreign key
            function ($category) {
                return $category['id'];
            },
            $this->fetchAll('SELECT id FROM categories')
        );
        for ($i = 0; $i < 100; $i++) {
            $timestamp = $faker->unixTime('now');
            $title = $faker->sentence(5);
            $posts[] = [
                'category_id' => $categories[rand(0, 9)],
                'author' => $faker->name(),
                'slug' => str_replace(' ', '-', strtolower(trim($title, '.'))),
                'title' => $title,
                'subtitle' => $faker->sentence(7),
                'content' => $faker->text(500),
                'created_at' => date('Y-m-d H:i:s', $timestamp),
                'updated_at' => date('Y-m-d H:i:s', $timestamp),
                'published_at' => date('Y-m-d H:i:s', $timestamp),
                'online' => rand(-1, 1)
            ];
        }
        $this->insert('posts', $posts);
        /** ### End Posts Seed ### */

        /** ### Comments Seed ### */
        $comments  = [];
        $posts = array_map( // Select posts for the foreign key
            function ($post) {
                return $post['id'];
            },
            $this->fetchAll('SELECT id FROM posts')
        );
        for ($i = 0; $i < 1500; $i++) {
            $timestamp = $faker->unixTime('now');
            $comments[] = [
                'post_id' => $posts[rand(0, 99)],
                'parent_id' => 0,
                'author' => $faker->firstName() . $faker->lastName(),
                'email' => $faker->email(),
                'content' => $faker->paragraph(),
                'created_at' => date('Y-m-d H:i:s', $timestamp)
            ];
        }
        $this->insert('comments', $comments);
        /** ### End Comments Seed ### */
    }
}
