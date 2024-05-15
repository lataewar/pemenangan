<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\TimsesRequest;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Timses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class TimsesController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public function index()
  {
    return view('timses.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('timses.table')->render()
      ]);
    }

    $data = Timses::with('kelurahan:id,name')->where('role_id', null);

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtnA(
          route('timses.edit', ['timse' => $data->id])
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
    return view('timses.create', ['kabupatens' => $kabupatens]);
  }

  public function store(TimsesRequest $request)
  {
    // dd($request->all());
    $query = Timses::create([
      'name' => $request->name,
      'email' => $request->email,
      'no_tlp' => $request->no_tlp,
      'alamat' => $request->alamat,
      'kelurahan_id' => $request->kelurahan_id,
      'password' => Hash::make('12345678'),
    ]);
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('timses.index');
  }

  public function edit(Timses $timse)
  {
    $kecamatan_id = $timse->kelurahan->kecamatan_id;
    $kabupaten_id = $timse->kelurahan->kecamatan->kabupaten_id;
    $kabupatens = Kabupaten::get();
    $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
    $kelurahans = Kelurahan::where('kecamatan_id', $kecamatan_id)->get();

    return view('timses.edit', [
      'kabupatens' => $kabupatens,
      'kecamatans' => $kecamatans,
      'kelurahans' => $kelurahans,
      'kabupaten_id' => $kabupaten_id,
      'kecamatan_id' => $kecamatan_id,
      'data' => $timse
    ]);
  }

  public function update(TimsesRequest $request, Timses $timse)
  {
    $query = $timse->update([
      'name' => $request->name,
      'email' => $request->email,
      'no_tlp' => $request->no_tlp,
      'alamat' => $request->alamat,
      'kelurahan_id' => $request->kelurahan_id,
    ]);
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('timses.index');
  }

  public function destroy(Timses $timse)
  {
    try {
      // Delete Tim Sukses
      $timse->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Timses::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
