<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pemilu;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $pemilu = Pemilu::count();

    $query_pie_chart = DB::table('calon_pemilu')
      ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
      // ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
      ->select(['calons.id', 'calons.name', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
      ->groupBy(['calons.id', 'calons.name', 'calons.is_selected'])
      ->get();

    $pie_chart['suaras'] = [];
    $pie_chart['calon'] = [];
    $pie_chart['is_selected'] = [];

    foreach ($query_pie_chart as $item) {
      array_push($pie_chart['suaras'], (int)$item->suaras);
      array_push($pie_chart['calon'], $item->name);
      array_push($pie_chart['is_selected'], $item->is_selected ? "#1BC5BD" : "#B5B5C3");
    }

    $target = Pengaturan::get()->first()->target_persentase;

    $query_colum_chart =
      DB::table('kabupatens')
      ->join('kecamatans', 'kecamatans.kabupaten_id', '=', 'kabupatens.id')
      ->join('kelurahans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->join('dpts', 'dpts.kelurahan_id', '=', 'kelurahans.id')
      ->select([
        'kabupatens.id',
        'kabupatens.name',
        'kabupatens.jumlah_dpt',
        DB::raw('COUNT(dpts.id) as suaras'),
        DB::raw('ROUND(' . $target . ' / 100 * kabupatens.jumlah_dpt) as target')
      ])
      ->groupBy(['kabupatens.id', 'kabupatens.name', 'kabupatens.jumlah_dpt'])
      ->get();

    $column_chart['target_persen'] = $target;
    $column_chart['jumlah_dpt'] = [];
    $column_chart['target'] = [];
    $column_chart['realisasi'] = [];
    $column_chart['categories'] = [];

    foreach ($query_colum_chart as $item) {
      array_push($column_chart['jumlah_dpt'], $item->jumlah_dpt);
      array_push($column_chart['target'], (int)$item->target);
      array_push($column_chart['realisasi'], $item->suaras);
      array_push($column_chart['categories'], $item->name);
    }

    return view('dashboard.index', [
      'column_chart' => $column_chart,
      'pie_chart' => $pie_chart,
      'pemilu_count' => $pemilu,
    ]);
  }
}
