<?php

namespace Database\Seeders;


use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('staff')->insert([
            'name' => "Default",
            'password' => Hash::make('password'),
            'created_at' => new DateTime(),
            'updated_at' => new Datetime(),
        ]);

         DB::table('branches')->insert([
            'name' => "Default Branch",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed vulputate mi sit amet mauris.",
            'email' => "default.branch@gmail.com",
            'phone' => "0800 838 383",
            'address' => "102 Default Rd",
            'created_at' => new DateTime(),
            'updated_at' => new Datetime(),
        ]);

         DB::table('suppliers')->insert([
            'name' => "Default Supplier",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed vulputate mi sit amet mauris.",
            'email' => "default.supplier@gmail.com",
            'phone' => "0800 838 383",
            'address' => "103 Default Rd",
            'created_at' => new DateTime(),
            'updated_at' => new Datetime(),
        ]);
         DB::table('product_categories')->insert([
            'name' => "Default Product Category",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida cum sociis natoque penatibus et magnis dis.",
            'created_at' => new DateTime(),
            'updated_at' => new Datetime(),
        ]);

        $brcdInt = 0;
        for($i = 1; $i <= 3; $i++){
            DB::table('products')->insert([
               'product_category_id' => 1,
               'supplier_id' => 1,
               'name' => "product$i",
               'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida cum sociis natoque penatibus et magnis dis.",
               'created_at' => new DateTime(),
               'updated_at' => new Datetime(),
            ]);

            for($k = 0; $k <= 5; $k++){
                DB::table('product_variations')->insert([
               'product_id' => $i,
               'name' => "variation$k",
               'cost' => rand(120, 5700) / 100,
               'retail_price' => rand(120, 5700) / 100,
               'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Gravida cum sociis natoque penatibus et magnis dis.",
               'barcode_0' => "brcd$brcdInt",
               'created_at' => new DateTime(),
               'updated_at' => new Datetime(),
                ]);
                $brcdInt++;
            }
        }


    }
}
