<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['HTML', 'CSS', 'JavaScript', 'PHP'];

        foreach($data as $cat){
            $new_category = new Category();

            $new_category->name = $cat;
            $new_category->slug = Str::slug($cat, '-');

            $new_category->save();
        }



    }
}
