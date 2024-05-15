<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Menu::insert([
      [
        'id' => 2,
        'name' => 'Pengaturan',
        'route' => null,
        'desc' => null,
        'has_submenu' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 3,
        'name' => 'TPS',
        'route' => 'tps.index',
        'desc' => 'Menu Data Tempat Pemungutan Suara',
        'has_submenu' => 0,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 4,
        'name' => 'Tim Sukses',
        'route' => 'timses.index',
        'desc' => 'Menu Data Tim Sukses',
        'has_submenu' => 0,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 5,
        'name' => 'DPT',
        'route' => 'dpt.index',
        'desc' => 'Menu Daftar Pemilih Tetap',
        'has_submenu' => 0,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'name' => 'Calon',
        'route' => 'calon.index',
        'desc' => 'Menu Calon',
        'has_submenu' => 0,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    DB::table('menu_role')->insert([
      ['menu_id' => 2, 'role_id' => 1],
      ['menu_id' => 3, 'role_id' => 1],
      ['menu_id' => 4, 'role_id' => 1],
      ['menu_id' => 5, 'role_id' => 1],
      ['menu_id' => 6, 'role_id' => 1],
    ]);

    SubMenu::insert([
      [
        'id' => 4,
        'menu_id' => 2,
        'name' => 'Kabupaten/Kota',
        'route' => 'kabupaten.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 5,
        'menu_id' => 2,
        'name' => 'Kecamatan',
        'route' => 'kecamatan.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 6,
        'menu_id' => 2,
        'name' => 'Desa/Kelurahan',
        'route' => 'kelurahan.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 7,
        'menu_id' => 2,
        'name' => 'Perhitungan',
        'route' => 'pengaturan.index',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    Kabupaten::insert([
      [
        'id' => 1,
        'name' => 'Bau-bau',
        'status' => 'Kota',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 2,
        'name' => 'Buton',
        'status' => 'Kabupaten',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 3,
        'name' => 'Buton Selatan',
        'status' => 'Kabupaten',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 4,
        'name' => 'Buton Tengah',
        'status' => 'Kabupaten',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => 5,
        'name' => 'Wakatobi',
        'status' => 'Kabupaten',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    // Kecamatan::insert([
    //   [
    //     'id' => 1,
    //     'kabupaten_id' => 1,
    //     'name' => 'Lamangga',
    //     'created_at' => now(),
    //     'updated_at' => now(),
    //   ],
    //   [
    //     'id' => 2,
    //     'kabupaten_id' => 1,
    //     'name' => 'Lipu',
    //     'created_at' => now(),
    //     'updated_at' => now(),
    //   ],
    // ]);
  }
}
