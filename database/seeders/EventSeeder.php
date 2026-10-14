<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->delete();

        DB::table('events')->insert([
            [
                'name'        => 'Pestapora',
                'category'    => 'Festival',
                'price'       => 200000,
                'description' => 'Pestapora bakal balik lagi buat nemenin 3 hari penuh keseruan kamu di Gambir Expo Kemayoran! Ratusan musisi favorit lintas generasi dari pop, rock, indie, sampai dangdut yang super megah.',
                'image'       => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'SingerPride',
                'category'    => 'Musik',
                'price'       => 160000,
                'description' => 'Ratusan penampil, belasan panggung, dan ribuan cerita dalam tiga hari penuh! SingerPride menghadirkan pengalaman festival yang super beda dengan line-up spektakuler lintas genre.',
                'image'       => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Brostade',
                'category'    => 'Musik',
                'price'       => 165000,
                'description' => 'Brostade akan mengadakan acara paling meriah sepanjang masa! Brostade akan membawa malam kalian menjadi malam yang tak terlupakan!.',
                'image'       => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Rells Addict',
                'category'    => 'Musik',
                'price'       => 180000,
                'description' => 'Ratusan penampil, belasan panggung, dan ribuan cerita dalam tiga hari penuh! Rells Addict menghadirkan pengalaman festival yang super beda dengan line-up spektakuler lintas genre.',
                'image'       => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Elite Founders',
                'category'    => 'Seminar',
                'price'       => 150000,
                'description' => 'Acara ini hadir menjadi suatu inspirasi bagi ribuan pelajar untuk percaya diri membangun semangat dan memulai usaha dari mulai usaha kecil.',
                'image'       => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
