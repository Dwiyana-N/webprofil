<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commissariat;

class KomisariatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //id 1
        Commissariat::create([ 
            'name'      => 'Komisariat Jalan Cagak',
            'slug'      => 'komisariat-jalan-cagak',            
        ]);
        //id 2
        Commissariat::create([
            'name'      => 'Komisariat Subang',
            'slug'      => 'komisariat-subang',            
        ]);
        //id 3
        Commissariat::create([
            'name'      => 'Komisariat Pagaden',
            'slug'      => 'komisariat-pagaden',            
        ]);
        //id 4
        Commissariat::create([
            'name'      => 'Komisariat Pamanukan',
            'slug'      => 'komisariat-pamanukan',            
        ]);
        //id 5
        Commissariat::create([
            'name'      => 'Komisariat Ciasem',
            'slug'      => 'komisariat-ciasem',            
        ]);
        //id 6
        Commissariat::create([
            'name'      => 'Komisariat Kalijati',
            'slug'      => 'komisariat-kalijati',            
        ]);
    }
}
