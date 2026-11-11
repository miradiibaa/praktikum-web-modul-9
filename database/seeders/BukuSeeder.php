<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $pemrograman = Kategori::where('nama', 'Pemrograman')->first();
        $basisData = Kategori::where('nama', 'Basis Data')->first();

        Buku::firstOrCreate(
            ['kode' => 'BK001'],
            [
                'judul' => 'Dasar PHP',
                'kategori_id' => $pemrograman->id,
            ]
        );

        Buku::firstOrCreate(
            ['kode' => 'BK002'],
            [
                'judul' => 'Belajar Laravel',
                'kategori_id' => $pemrograman->id,
            ]
        );
    }
}
