<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinsiSeeder::class,
            KotaSeeder::class,
            OccupancyTypeSeeder::class,
            PromoCodeSeeder::class,
            UserAdminSeeder::class,
            KontakSeeder::class,
            KategoriSeeder::class,
            SubKategoriSeeder::class,
            ProdukSeeder::class,
            KeranjangSeeder::class,
            PesananSeeder::class,
            UlasanSeeder::class,
            QnAseeder::class,
        ]);
    }
}
