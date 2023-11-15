<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($a=1; $a<=5; $a++){
            $obj=new Product();
        $obj->name=$faker->name;
        $obj->price=$faker->numberBetween(1000, 10000);
        $obj->description=$faker->text;
    $obj->image=$faker->imageUrl(640,480);
        $obj->save();
        }
    }
}
