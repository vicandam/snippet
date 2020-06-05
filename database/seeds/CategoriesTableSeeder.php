<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('categories')->truncate();

        $categories =
            [
                ['name' => 'PHP', 'image' => 'php.png'],
                ['name' => 'Laravel', 'image' => 'laravel.png'],
                ['name' => 'Javascript', 'image' => 'javascript.png'],
                ['name' => 'Jquery', 'image' => 'jquery.png'],
                ['name' => 'CSS', 'image' => 'css.png'],
                ['name' => 'Bootstrap', 'image' => 'bootstrap.png'],
                ['name' => 'Composer', 'image' => 'composer.png'],
                ['name' => 'Shopify', 'image' => 'shopify.png'],
                ['name' => 'Wordpress', 'image' => 'wordpress.png'],
                ['name' => 'PHP Unit', 'image' => 'php_unit.png'],
                ['name' => 'Vue', 'image' => 'vue.png']
            ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
