<?php

namespace App\Database\Seeds;

use App\Models\PrintModel;
use App\Database\Factories\PrintModelFactory;
use Illuminate\Database\Seeder;

class PrintModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // You can directly create db records

        // $printmodel = new PrintModel();
        // $printmodel->field = 'value';
        // $printmodel->save();

        // or

        // PrintModel::create([
        //    'field' => 'value'
        // ]);

        (new PrintModelFactory)->create(50)->save();
    }
}
