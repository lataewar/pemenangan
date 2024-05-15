<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pemilu;
use App\Models\Tps;
use App\Services\KpuApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectorController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq');
  }

  private static function kabs($selected = 0)
  {
    $kabupatens = Kabupaten::all();

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($kabupatens as $row) {
      if ($row['id'] == $selected) {
        $data .= "<option value='" . $row['id'] . "' selected>" . $row['status'] . " " . $row['name'] . "</option>";
      } else {
        $data .= "<option value='" . $row['id'] . "'>" . $row['status'] . " " . $row['name'] . "</option>";
      }
    }

    return $data;
  }

  private static function kecs($id, $selected = 0)
  {
    $kecamatans = Kecamatan::where('kabupaten_id', $id)->get();

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($kecamatans as $row) {
      if ($row['id'] == $selected) {
        $data .= "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
      } else {
        $data .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
      }
    }

    return $data;
  }

  private static function kels($id, $selected = 0)
  {
    $kelurahans = Kelurahan::where('kecamatan_id', $id)->get();

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($kelurahans as $row) {
      if ($row['id'] == $selected) {
        $data .= "<option value='" . $row['id'] . "' selected>" . $row['status'] . " " . $row['name'] . "</option>";
      } else {
        $data .= "<option value='" . $row['id'] . "'>" . $row['status'] . " " . $row['name'] . "</option>";
      }
    }

    return $data;
  }

  private static function tpss($id, $selected = 0)
  {
    $tps = Tps::where('kelurahan_id', $id)->get();

    $data = "<option value='' hidden>Pilih salah satu ...</option>";
    foreach ($tps as $row) {
      if ($row['id'] == $selected) {
        $data .= "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
      } else {
        $data .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
      }
    }

    return $data;
  }

  public function getKec(Request $request)
  {
    return json_encode(["data" => self::kecs($request->kab)]);
  }

  public function getKel(Request $request)
  {
    return json_encode(["data" => self::kels($request->kec)]);
  }

  public function getTps(Request $request)
  {
    return json_encode(["data" => self::tpss($request->kel)]);
  }

  public function selectTps(Request $request)
  {
    $q = $request->q;

    $tps_ids = Pemilu::get()->pluck('tps_id');

    $query = DB::table('tps')
      ->join('kelurahans', 'tps.kelurahan_id', '=', 'kelurahans.id')
      ->join('kecamatans', 'kelurahans.kecamatan_id', '=', 'kecamatans.id')
      ->join('kabupatens', 'kecamatans.kabupaten_id', '=', 'kabupatens.id')
      ->select('tps.id', 'tps.name', 'tps.alamat', 'kelurahans.status as skel', 'kelurahans.name as kelurahan', 'kecamatans.name as kecamatan', 'kabupatens.status as skab', 'kabupatens.name as kabupaten')
      ->whereNotIn('tps.id', $tps_ids)
      ->where('tps.name', 'LIKE', '%' . $q . '%')
      ->orWhere('tps.alamat', 'LIKE', '%' . $q . '%')
      ->orWhere('kelurahans.name', 'LIKE', '%' . $q . '%')
      ->paginate(15);

    return response()->json([
      'total_count' => $query->total(),
      'incomplete_results' => false,
      'items' => $query->items(),
    ]);
  }

  public function ceknik(Request $request)
  {
    $request->validate([
      'nik' => ['required', 'min:16', 'max:16', 'unique:dpts,nik'],
    ]);

    $kpu_service = new KpuApiService();
    $response = $kpu_service->getdata($request->nik);
    $r_kab = $kpu_service->removestring($response['kabupaten']);
    $r_kec = $kpu_service->removestring($response['kecamatan']);
    $r_kel = $kpu_service->removestring($response['kelurahan']);
    $r_tps = $response['tps'];

    $data = [];

    $kab = Kabupaten::where('name', 'LIKE', '%' . $r_kab . '%')->first();
    $data['kabupatens'] = self::kabs();

    if ($kab) {
      $data['kabupatens'] = self::kabs($kab->id);
      $kec = Kecamatan::where('name', 'LIKE', '%' . $r_kec . '%')->first();
      if ($kec) {
        $data['kecamatans'] = self::kecs($kab->id, $kec->id);
        $kel = Kelurahan::where('name', 'LIKE', '%' . $r_kel . '%')->first();
        if ($kel) {
          $data['kelurahans'] = self::kels($kec->id, $kel->id);
          $tps = Tps::where('name', $r_tps)->first();
          if ($tps) {
            $data['tpss'] = self::tpss($kel->id, $tps->id);
          }
        }
      }
    }

    return response()->json(
      [
        'data' => $response,
        'locs' => $data,
      ]
    );
  }
}
