<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\KabupatenRequest;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class KelurahanController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public $kec;

  public function index($kec = 0)
  {
    $routes = [
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index')],
      ['name' => 'Desa/Kelurahan', 'route' => route('kelurahan.index', ['kec' => $kec])],
    ];

    return view('kelurahan.index', ['id' => $kec, 'routes' => $routes]);
  }

  public function dt($kec = 0)
  {
    if (request()->type == 'table') {
      $kabs = Kabupaten::get();
      if ($kec) {
        $kecamatan = Kecamatan::find($kec);
        $kecamatans = Kecamatan::where('kabupaten_id', $kecamatan->kabupaten_id)->get();
      } else {
        $kecamatan = null;
        $kecamatans = [];
      }

      return json_encode([
        'data' => view('kelurahan.table', [
          'kabs' => $kabs,
          'kecs' => $kecamatans,
          'kec' => $kecamatan,
          'id' => $kec
        ])->render()
      ]);
    }

    $data = Kecamatan::find($kec);

    if ($data) $data = $data->kelurahans;
    else $data = [];
    $this->kec = $kec;

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtnA(route('kelurahan.edit', ['kec' => $this->kec, 'kelurahan' => $data->id])) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('name', function ($data) {
        return $data->status . " " . $data->name;
      })
      ->rawColumns(['aksi', 'cb', 'name'])
      ->make();
  }

  public function create(Kecamatan $kec)
  {
    $routes = [
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index')],
      ['name' => 'Desa/Kelurahan', 'route' => route('kelurahan.index', ['kec' => $kec->id])],
    ];

    $status = [
      ['id' => 'Desa', 'name' => 'Desa',],
      ['id' => 'Kelurahan', 'name' => 'Kelurahan',],
    ];

    return view('kelurahan.create', [
      'kec' => $kec,
      'routes' => $routes,
      'status' => $status,
    ]);
  }

  public function store(Kecamatan $kec, KabupatenRequest $request)
  {
    $query = Kelurahan::create($request->all() + ['kecamatan_id' => $kec->id]);
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('kelurahan.index', ['kec' => $kec->id]);
  }

  public function edit(Kecamatan $kec, Kelurahan $kelurahan)
  {
    $routes = [
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index')],
      ['name' => 'Desa/Kelurahan', 'route' => route('kelurahan.index', ['kec' => $kec->id])],
    ];

    $status = [
      ['id' => 'Desa', 'name' => 'Desa',],
      ['id' => 'Kelurahan', 'name' => 'Kelurahan',],
    ];

    return view('kelurahan.edit', [
      'kec' => $kec,
      'routes' => $routes,
      'data' => $kelurahan,
      'status' => $status,
    ]);
  }

  public function update($kec, KabupatenRequest $request, Kelurahan $kelurahan)
  {
    $query = $kelurahan->update($request->all() + ['kecamatan_id' => $kec]);
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('kelurahan.index', ['kec' => $kec]);
  }

  public function destroy($kec, Kelurahan $kelurahan)
  {
    try {
      // Delete Kelurahan
      $kelurahan->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Kelurahan::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
