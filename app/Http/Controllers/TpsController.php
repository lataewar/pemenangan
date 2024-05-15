<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\TpsRequest;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tps;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class TpsController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public function index()
  {
    return view('tps.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('tps.table')->render()
      ]);
    }

    $data = Tps::with('kelurahan:id,name');

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtnA(
          route('tps.edit', ['tp' => $data->id])
        ) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('kelurahan', function ($data) {
        return $data->kelurahan->name;
      })
      ->rawColumns(['aksi', 'cb', 'kelurahan'])
      ->make();
  }

  public function create()
  {
    $kabupatens = Kabupaten::get();
    return view('tps.create', ['kabupatens' => $kabupatens]);
  }

  public function store(TpsRequest $request)
  {
    // dd($request->all());
    $query = Tps::create($request->all());
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('tps.index');
  }

  public function edit(Tps $tp)
  {
    $kecamatan_id = $tp->kelurahan->kecamatan_id;
    $kabupaten_id = $tp->kelurahan->kecamatan->kabupaten_id;
    $kabupatens = Kabupaten::get();
    $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
    $kelurahans = Kelurahan::where('kecamatan_id', $kecamatan_id)->get();

    return view('tps.edit', [
      'kabupatens' => $kabupatens,
      'kecamatans' => $kecamatans,
      'kelurahans' => $kelurahans,
      'kabupaten_id' => $kabupaten_id,
      'kecamatan_id' => $kecamatan_id,
      'data' => $tp
    ]);
  }

  public function update(TpsRequest $request, Tps $tp)
  {
    $query = $tp->update($request->all());
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('tps.index');
  }

  public function destroy(Tps $tp)
  {
    try {
      // Delete Tps
      $tp->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Tps::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
