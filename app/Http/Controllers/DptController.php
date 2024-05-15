<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\DptRequest;
use App\Http\Requests\TpsRequest;
use App\Models\Dpt;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Tps;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class DptController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public function index()
  {
    return view('dpt.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('dpt.table')->render()
      ]);
    }

    $data = Dpt::with(['kelurahan:id,name', 'tps:id,name']);

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtnA(
          route('dpt.edit', ['dpt' => $data->id])
        ) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('kelurahan', function ($data) {
        return $data->kelurahan->name;
      })
      ->addColumn('tps', function ($data) {
        return $data->tps->name;
      })
      ->rawColumns(['aksi', 'cb', 'kelurahan', 'tps'])
      ->make();
  }

  public function create()
  {
    $kabupatens = Kabupaten::get();
    return view('dpt.create', ['kabupatens' => $kabupatens]);
  }

  public function store(DptRequest $request)
  {
    // dd($request->all());
    $query = Dpt::create($request->all() + ['timses_id' => 1]);
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('dpt.index');
  }

  public function edit(Dpt $dpt)
  {
    $kecamatan_id = $dpt->kelurahan->kecamatan_id;
    $kabupaten_id = $dpt->kelurahan->kecamatan->kabupaten_id;
    $kabupatens = Kabupaten::get();
    $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
    $kelurahans = Kelurahan::where('kecamatan_id', $kecamatan_id)->get();
    $tps = Tps::where('kelurahan_id', $dpt->kelurahan_id)->get();

    return view('dpt.edit', [
      'kabupatens' => $kabupatens,
      'kecamatans' => $kecamatans,
      'kelurahans' => $kelurahans,
      'tps' => $tps,
      'kabupaten_id' => $kabupaten_id,
      'kecamatan_id' => $kecamatan_id,
      'data' => $dpt
    ]);
  }

  public function update(DptRequest $request, Dpt $dpt)
  {
    // dd($request->all());
    $query = $dpt->update($request->all());
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('dpt.index');
  }

  public function destroy(Dpt $dpt)
  {
    try {
      // Delete DPT
      $dpt->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Dpt::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
