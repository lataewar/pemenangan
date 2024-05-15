<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\KabupatenRequest;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class KecamatanController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete',]);
  }

  public function index($kab = 0)
  {
    $routes = [
      ['name' => 'Kab/Kota', 'route' => route('kabupaten.index')],
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index', ['kab' => $kab])],
    ];

    return view('kecamatan.index', ['id' => $kab, 'routes' => $routes]);
  }

  public function dt($kab = 0)
  {
    if (request()->type == 'table') {
      $kabs = Kabupaten::get();
      return json_encode([
        'data' => view('kecamatan.table', ['kabs' => $kabs, 'id' => $kab])->render()
      ]);
    }

    $data = Kabupaten::find($kab);

    if ($data) $data = $data->kecamatans;
    else $data = [];

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) use ($kab) {
        $kec = DtHelper::btn("kelurahan/" . $data->id, "Data Kelurahan");
        return $kec . DtHelper::editBtnA(route('kecamatan.edit', ['kab' => $kab, 'kecamatan' => $data->id])) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb'])
      ->make();
  }

  public function create(Kabupaten $kab)
  {
    $routes = [
      ['name' => 'Kab/Kota', 'route' => route('kabupaten.index')],
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index', ['kab' => $kab->id])],
    ];

    return view('kecamatan.create', ['kab' => $kab, 'routes' => $routes]);
  }

  public function store(Kabupaten $kab, KabupatenRequest $request)
  {
    $query = Kecamatan::create($request->all() + ['kabupaten_id' => $kab->id]);
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('kecamatan.index', ['kab' => $kab->id]);
  }

  public function edit(Kabupaten $kab, Kecamatan $kecamatan)
  {
    $routes = [
      ['name' => 'Kab/Kota', 'route' => route('kabupaten.index')],
      ['name' => 'Kecamatan', 'route' => route('kecamatan.index', ['kab' => $kab->id])],
    ];

    return view('kecamatan.edit', [
      'kab' => $kab,
      'routes' => $routes,
      'data' => $kecamatan,
    ]);
  }

  public function update($kab, KabupatenRequest $request, Kecamatan $kecamatan)
  {
    $query = $kecamatan->update($request->all() + ['kabupaten_id' => $kab]);
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('kecamatan.index', ['kab' => $kab]);
  }

  public function destroy($kab, Kecamatan $kecamatan)
  {
    try {
      // Delete Kecamatan
      $kecamatan->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Kecamatan::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
