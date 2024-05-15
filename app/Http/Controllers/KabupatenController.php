<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\KabupatenRequest;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class KabupatenController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public function index()
  {
    return view('kabupaten.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('kabupaten.table')->render()
      ]);
    }

    $data = Kabupaten::get();

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        $kec = DtHelper::btn("kecamatan/" . $data->id, "Data Kecamatan");
        return $kec . DtHelper::editBtnA(route('kabupaten.edit', ['kabupaten' => $data->id])) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('kabupaten', function ($data) {
        return $data->status . " " . $data->name;
      })
      ->addColumn('jumlah_dpt', function ($data) {
        return formatNomor($data->jumlah_dpt);
      })
      ->rawColumns(['aksi', 'cb', 'kabupaten', 'jumlah_dpt'])
      ->make();
  }

  public function create()
  {
    $status = [
      ['id' => 'Kabupaten', 'name' => 'Kabupaten',],
      ['id' => 'Kota', 'name' => 'Kota',],
    ];

    return view('kabupaten.create', ['status' => $status]);
  }

  public function store(KabupatenRequest $request)
  {
    $query = Kabupaten::create($request->except('jumlah_dpt') + ['jumlah_dpt' => str_replace(".", "", $request->jumlah_dpt)]);
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('kabupaten.index');
  }

  public function edit(Kabupaten $kabupaten)
  {
    $status = [
      ['id' => 'Kabupaten', 'name' => 'Kabupaten',],
      ['id' => 'Kota', 'name' => 'Kota',],
    ];

    return view('kabupaten.edit', ['status' => $status, 'data' => $kabupaten]);
  }

  public function update(KabupatenRequest $request, Kabupaten $kabupaten)
  {
    $query = $kabupaten->update($request->except('jumlah_dpt') + ['jumlah_dpt' => str_replace(".", "", $request->jumlah_dpt)]);
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('kabupaten.index');
  }

  public function destroy(Kabupaten $kabupaten)
  {
    try {
      // Delete Kabupaten
      $kabupaten->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Kabupaten::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
