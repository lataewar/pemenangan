<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pemilu;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\DB;

class HitungController extends Controller
{

  public function index()
  {

    $query = Kabupaten::get()->map(function ($item) {

      $item->calons = DB::table('calon_pemilu')
        ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
        ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
        ->join('tps', 'pemilus.tps_id', '=', 'tps.id')
        ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
        ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
        ->join('kabupatens', 'kecamatans.kabupaten_id', '=', 'kabupatens.id')
        ->select(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
        ->groupBy(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected'])
        ->where('kabupatens.id', $item->id)
        ->get();

      return $item;
    });

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

    return view('dashboard.hitung.kab', [
      'data' => $query,
      'pie_chart' => $pie_chart,
    ]);
  }

  public function kecamatan($kab)
  {
    $kabupaten = Kabupaten::find($kab);
    $query = Kecamatan::where('kabupaten_id', $kab)->get()->map(function ($item) {

      $item->calons = DB::table('calon_pemilu')
        ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
        ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
        ->join('tps', 'pemilus.tps_id', '=', 'tps.id')
        ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
        ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
        ->select(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
        ->groupBy(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected'])
        ->where('kecamatans.id', $item->id)
        ->get();

      return $item;
    });

    $query_pie_chart = DB::table('calon_pemilu')
      ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
      ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
      ->join('tps', 'pemilus.tps_id', '=', 'tps.id')
      ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
      ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->join('kabupatens', 'kecamatans.kabupaten_id', '=', 'kabupatens.id')
      ->select(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
      ->groupBy(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected'])
      ->where('kabupatens.id', $kab)
      ->get();

    $pie_chart['suaras'] = [];
    $pie_chart['calon'] = [];
    $pie_chart['is_selected'] = [];

    foreach ($query_pie_chart as $item) {
      array_push($pie_chart['suaras'], (int)$item->suaras);
      array_push($pie_chart['calon'], $item->name);
      array_push($pie_chart['is_selected'], $item->is_selected ? "#1BC5BD" : "#B5B5C3");
    }

    return view('dashboard.hitung.kec', [
      'kabupaten' => $kabupaten->status . " " . $kabupaten->name,
      'data' => $query,
      'pie_chart' => $pie_chart,
    ]);
  }

  public function kelurahan($kec)
  {
    $kecamatan = Kecamatan::find($kec);
    $query = Kelurahan::where('kecamatan_id', $kec)->get()->map(function ($item) {

      $item->calons = DB::table('calon_pemilu')
        ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
        ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
        ->join('tps', 'pemilus.tps_id', '=', 'tps.id')
        ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
        ->select(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
        ->groupBy(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected'])
        ->where('kelurahans.id', $item->id)
        ->get();

      return $item;
    });

    $query_pie_chart = DB::table('calon_pemilu')
      ->join('calons', 'calon_pemilu.calon_id', '=', 'calons.id')
      ->join('pemilus', 'calon_pemilu.pemilu_id', '=', 'pemilus.id')
      ->join('tps', 'pemilus.tps_id', '=', 'tps.id')
      ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
      ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->select(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected', DB::raw('SUM(calon_pemilu.suara) as suaras')])
      ->groupBy(['calons.id', 'calons.name', 'calons.no_urut', 'calons.is_selected'])
      ->where('kecamatans.id', $kec)
      ->get();

    $pie_chart['suaras'] = [];
    $pie_chart['calon'] = [];
    $pie_chart['is_selected'] = [];

    foreach ($query_pie_chart as $item) {
      array_push($pie_chart['suaras'], (int)$item->suaras);
      array_push($pie_chart['calon'], $item->name);
      array_push($pie_chart['is_selected'], $item->is_selected ? "#1BC5BD" : "#B5B5C3");
    }

    return view('dashboard.hitung.kel', [
      'kecamatan' => $kecamatan,
      'data' => $query,
      'pie_chart' => $pie_chart,
    ]);
  }
}
