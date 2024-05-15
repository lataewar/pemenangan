<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\CalonRequest;
use App\Models\Calon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class CalonController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete', 'pilih']);
  }

  public function index()
  {
    return view('calon.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('calon.table')->render()
      ]);
    }

    $data = Calon::orderBy('no_urut')->get();

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        $select = $data->is_selected ? "" :
          DtHelper::defaultBtn("selectCalon", $data->id . "-|-" . $data->name, "Pilih Calon", "General/Heart.svg");
        return $select . DtHelper::editBtnA(
          route('calon.edit', ['calon' => $data->id])
        ) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('name', function ($data) {
        $name = $data->is_selected ? DtHelper::label("Terpilih") : "";
        return $data->name . '<br>' . $name;
      })
      ->rawColumns(['aksi', 'cb', 'name'])
      ->make();
  }

  public function pilih(Request $request, Calon $calon)
  {
    Calon::query()->update(['is_selected' => null]);
    try {
      // Delete Calon
      $calon->update(['is_selected' => true]);
      return response()->json(['sukses' => $request->post('name') . ' berhasil dipilih.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function create()
  {
    return view('calon.create');
  }

  public function store(CalonRequest $request)
  {
    $query = Calon::create($request->all());
    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('calon.index');
  }

  public function edit(Calon $calon)
  {
    return view('calon.edit', ['data' => $calon]);
  }

  public function update(CalonRequest $request, Calon $calon)
  {
    // dd($request->all());
    $query = $calon->update($request->all());
    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('calon.index');
  }

  public function destroy(Calon $calon)
  {
    try {
      // Delete Calon
      $calon->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      Calon::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
