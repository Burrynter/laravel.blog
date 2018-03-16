<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat1 = new Category();
        $cat1->name = 'Category 1';
        $cat1->slug = 'category-1';
        $cat1->desc = 'First Category';
        $cat1->save();

        $cat2 = new Category();
        $cat2->name = 'Category 2';
        $cat2->slug = 'category-2';
        $cat2->desc = 'Second Category';
        $cat2->save();

        $cat3 = new Category();
        $cat3->name = 'Category 3';
        $cat3->slug = 'category-3';
        $cat3->desc = 'Third Category';
        $cat3->save();

        $cat4 = new Category();
        $cat4->name = 'Category 4';
        $cat4->slug = 'category-4';
        $cat4->desc = 'Fourth Category';
        $cat4->save();

        $cat5 = new Category();
        $cat5->name = 'Category 5';
        $cat5->slug = 'category-5';
        $cat5->desc = 'Fifth Category';
        $cat5->save();

        $cat6 = new Category();
        $cat6->name = 'Category 6';
        $cat6->slug = 'category-6';
        $cat6->desc = 'Sixth Category';
        $cat6->save();

        $cat7 = new Category();
        $cat7->name = 'Category 7';
        $cat7->slug = 'category-7';
        $cat7->desc = 'Seventh Category';
        $cat7->save();
    }
}
