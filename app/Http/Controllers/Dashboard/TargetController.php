<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{

  public function index()
  {

    $target = Pengaturan::get()->first()->target_persentase;

    $query =
      DB::table('kabupatens')
      ->join('kecamatans', 'kecamatans.kabupaten_id', '=', 'kabupatens.id')
      ->join('kelurahans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->join('dpts', 'dpts.kelurahan_id', '=', 'kelurahans.id')
      ->select([
        'kabupatens.id',
        'kabupatens.name',
        'kabupatens.status',
        'kabupatens.jumlah_dpt',
        DB::raw('COUNT(dpts.id) as suaras'),
        DB::raw('ROUND(' . $target . ' / 100 * kabupatens.jumlah_dpt) as target')
      ])
      ->groupBy(['kabupatens.id', 'kabupatens.name', 'kabupatens.status', 'kabupatens.jumlah_dpt'])
      ->get();

    $column_chart['target_persen'] = $target;
    $column_chart['jumlah_dpt'] = [];
    $column_chart['target'] = [];
    $column_chart['realisasi'] = [];
    $column_chart['categories'] = [];

    foreach ($query as $item) {
      array_push($column_chart['jumlah_dpt'], $item->jumlah_dpt);
      array_push($column_chart['target'], (int)$item->target);
      array_push($column_chart['realisasi'], $item->suaras);
      array_push($column_chart['categories'], $item->name);
    }

    return view('dashboard.target.kab', [
      'target' => $target,
      'data' => $query,
      'column_chart' => $column_chart,
    ]);
  }

  public function kecamatan($kab)
  {
    $kabupaten = Kabupaten::find($kab);
    $query =
      DB::table('kecamatans')
      ->join('kelurahans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->join('dpts', 'dpts.kelurahan_id', '=', 'kelurahans.id')
      ->select([
        'kecamatans.id',
        'kecamatans.name',
        DB::raw('COUNT(dpts.id) as suaras'),
      ])
      ->groupBy(['kecamatans.id', 'kecamatans.name'])
      ->where('kecamatans.kabupaten_id', $kab)
      ->get();

    $total = 0;
    foreach ($query as $item) {
      $total += $item->suaras;
    }

    return view('dashboard.target.kec', [
      'kabupaten' => $kabupaten->status . " " . $kabupaten->name,
      'data' => $query,
      'total' => $total,
    ]);
  }

  public function kelurahan($kec)
  {
    $kecamatan = Kecamatan::find($kec);
    $query =
      DB::table('kelurahans')
      ->join('dpts', 'dpts.kelurahan_id', '=', 'kelurahans.id')
      ->select([
        'kelurahans.id',
        'kelurahans.name',
        'kelurahans.status',
        DB::raw('COUNT(dpts.id) as suaras'),
      ])
      ->groupBy(['kelurahans.id', 'kelurahans.name', 'kelurahans.status'])
      ->where('kelurahans.kecamatan_id', $kec)
      ->get();

    $total = 0;
    foreach ($query as $item) {
      $total += $item->suaras;
    }

    return view('dashboard.target.kel', [
      'kecamatan' => $kecamatan,
      'data' => $query,
      'total' => $total,
    ]);
  }
}
