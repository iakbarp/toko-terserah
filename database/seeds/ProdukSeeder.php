<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const ProdukArray = [
        'Happy Tos Merah',
        'Happy Tos Hijau',
        'Happy Tos Roasted Corn',
        'Happy Tos Nacho Cheese',
        'Happy Tos SeaWeed',
        'Happy Tos Roasted Corn 150 Gr',
    ];

    public function run()
    {
        $faker = Factory::create('id_ID');
        foreach (static::ProdukArray as $item) {
            $cek = rand(0, 1) ? true : false;
            $stock = abs(round((rand(100, 1000) + 50), -2));
            \App\Models\Produk::create([
                'nama' => $item,
                'permalink' => preg_replace("![^a-z0-9]+!i", "-", strtolower($item)),
                'gambar' => 'placeholder.jpg',
                'galeri' => $cek == true ? ['placeholder.jpg', 'placeholder.jpg'] : null,
                'kode_barang' => 'HT' . $faker->numerify('###'),
                'berat' => rand(50, 150),
                'stock' => $stock,
                'deskripsi' => $faker->paragraph,
                'detail' => '<h2>Detail Produk: ' . $item . '</h2><ul><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li></ul>',
                'barcode' => $faker->numerify('#######'),
                'sub_kategori_id' => rand(\App\Models\SubKategori::min('id'), \App\Models\SubKategori::max('id')),
                'isGrosir' => true,
                'min_qty' => $stock * 0.1,
                'harga_grosir' => abs(round((rand(1000, 100000) + 500), -3)),
                'isDiskonGrosir' => $cek,
                'diskonGrosir' => $cek == true ? rand(10, 50) : null
            ]);
        }

        foreach (\App\Models\Produk::where('isDiskonGrosir', true)->get() as $row) {
            $row->update([
                'harga_diskon_grosir' => ceil($row->harga_grosir - ($row->harga_grosir * $row->diskonGrosir / 100))
            ]);
        }

        $a = 1;
        for ($i = 0; $i < 50; $i++) {
            $cek = rand(0, 1) ? true : false;
            $name = ucwords($faker->words(rand(2, 4), true)) . ' ' . $a++;

            \App\Models\Produk::create([
                'nama' => $name,
                'permalink' => preg_replace("![^a-z0-9]+!i", "-", strtolower($name)),
                'gambar' => 'placeholder.jpg',
                'galeri' => $cek == true ? ['placeholder.jpg', 'placeholder.jpg'] : null,
                'kode_barang' => substr($name, 0, 1) . $faker->numerify('###'),
                'berat' => rand(50, 150),
                'stock' => rand(0, 10),
                'deskripsi' => $faker->paragraph,
                'detail' => '<h2>Detail Produk: ' . $name . '</h2><ul><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li><li>' . $faker->sentence . '</li></ul>',
                'barcode' => $faker->numerify('#######'),
                'sub_kategori_id' => rand(\App\Models\SubKategori::min('id'), \App\Models\SubKategori::max('id')),
                'harga' => abs(round((rand(1000, 100000) + 500), -3)),
                'is_diskon' => $cek,
                'diskon' => $cek == true ? rand(10, 50) : null
            ]);
        }

        foreach (\App\Models\Produk::where('is_diskon', true)->get() as $row) {
            $row->update([
                'harga_diskon' => ceil($row->harga - ($row->harga * $row->diskon / 100))
            ]);
        }
    }
}
