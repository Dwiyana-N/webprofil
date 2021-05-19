<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'name'          => 'Sekretariat',
            'slug'          => 'sekretariat',
            'description'   => 'Bagian Kesekretariatan',            
        ]);
        Field::create([
            'name'          => 'Bidang Pembinaan PAUD dan DIKMAS',
            'slug'          => 'bidang-pembinaan-paud-dan-dikmas',
            'description'   => 'Bidang Pembinaan PAUD dan Dikmas',            
        ]);
        Field::create([
            'name'          => 'Bidang Pembinaan Sekolah Dasar',
            'slug'          => 'bidang-pembinaan-sekolah-dasar',
            'description'   => 'Bidang Pembinaan Sekolah Dasar',            
        ]);
        Field::create([
            'name'          => 'Bidang Pembinaan Sekolah Menengah Pertama',
            'slug'          => 'bidang-pembinaan-sekolah-menengah-pertama',
            'description'   => 'Bidang Pembinaan SMP',            
        ]);
        Field::create([
            'name'          => 'Bidang Kebudayaan',
            'slug'          => 'bidang-kebudayaan',
            'description'   => 'Bidang Kebudayaan',            
        ]);
        Field::create([
            'name'          => 'Bidang Pembinaan Ketenagaan Pendidik dan Tenaga Kependidikan',
            'slug'          => 'bidang-pembinaan-ketenagaan-pendidik-dan-tenaga-kependidikan',
            'description'   => 'Bidang Pembinaan Ketenagaan Pendidik dan Tenaga Kependidikan',            
        ]);
        Field::create([
            'name'          => 'UPTD',
            'slug'          => 'uptd',
            'description'   => 'UPTD',            
        ]);
        Field::create([
            'name'          => 'Kelompok Jabatan Fungsional',
            'slug'          => 'kelompok-jabatan-fungsional',
            'description'   => 'Kelompok Jabatan Fungsional',            
        ]);
    }
}
