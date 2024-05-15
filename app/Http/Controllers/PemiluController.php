<?php

namespace App\Http\Controllers;

use App\Helpers\DtHelper;
use App\Http\Requests\PemiluRequest;
use App\Models\Calon;
use App\Models\Pemilu;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class PemiluController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->only(['dt', 'destroy', 'multdelete']);
  }

  public function index()
  {
    return view('pemilu.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('pemilu.table')->render()
      ]);
    }

    $data = Pemilu::with(['tps.kelurahan.kecamatan.kabupaten', 'calons']);

    return DataTables::of($data)
      ->addColumn('tps', function ($data) {
        return view('pemilu.tr.name', [
          'data' => $data,
        ])->render();
      })
      ->addColumn('kelurahan', function ($data) {
        return view('pemilu.tr.kel', [
          'kel' => $data->tps->kelurahan,
          'kec' => $data->tps->kelurahan->kecamatan,
          'kab' => $data->tps->kelurahan->kecamatan->kabupaten,
        ])->render();
      })
      ->addColumn('suara', function ($data) {
        return view('pemilu.tr.suara', [
          'data' => $data->calons,
        ])->render();
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtnA(
          route('pemilu.edit', ['pemilu' => $data->id])
        ) . DtHelper::deleteBtn($data->id, "TPS " . $data->tps->name);
      })
      ->rawColumns(['tps', 'kelurahan', 'suara', 'aksi', 'cb'])
      ->make();
  }

  public function create()
  {
    $calons = Calon::all();
    return view('pemilu.create', ['calons' => $calons]);
  }

  public function store(PemiluRequest $request)
  {

    $suaras = collect($request->suara)->map(function ($suara) {
      return ['suara' => $suara];
    });

    $query = Pemilu::create($request->all() + ['user_id' => auth()->user()->id]);
    $query->calons()->sync($suaras);

    $temporaryFile = TemporaryFile::where('folder', $request->file)->first();
    if ($temporaryFile) {
      $query
        ->addMedia(storage_path('app/public/files/tmp/' . $request->file . '/' . $temporaryFile->filename))
        ->toMediaCollection('pemilu_foto');

      rmdir(storage_path('app/public/files/tmp/' . $request->file));
      $temporaryFile->delete();
    }

    if ($query) Alert::success('Sukses', 'Data berhasil ditambahkan.');

    return redirect()->route('pemilu.index');
  }

  public function edit(Pemilu $pemilu)
  {
    // $calons = Calon::with('pemilus')->whereHas('pemilus', function ($query) use ($pemilu) {
    //   $query->where('id', $pemilu->id);
    // })->get();

    $calons = DB::table('calons')
      ->select(['calons.*', 'calon_pemilu.suara as suara'])
      ->join('calon_pemilu', 'calon_pemilu.calon_id', '=', 'calons.id')
      ->where('calon_pemilu.pemilu_id', $pemilu->id)
      ->get();

    return view('pemilu.edit', [
      'data' => $pemilu,
      'calons' => $calons,
    ]);
  }

  public function update(PemiluRequest $request, Pemilu $pemilu)
  {
    $suaras = collect($request->suara)->map(function ($suara) {
      return ['suara' => $suara];
    });

    $query = $pemilu->update($request->except('tps_id'));
    $pemilu->calons()->sync($suaras);

    $temporaryFile = TemporaryFile::where('folder', $request->file)->first();
    if ($temporaryFile) {
      $pemilu
        ->addMedia(storage_path('app/public/files/tmp/' . $request->file . '/' . $temporaryFile->filename))
        ->toMediaCollection('pemilu_foto');

      rmdir(storage_path('app/public/files/tmp/' . $request->file));
      $temporaryFile->delete();
    }

    if ($query) Alert::success('Sukses', 'Data berhasil diubah.');

    return redirect()->route('pemilu.index');
  }

  public function destroy(Pemilu $pemilu)
  {
    try {
      // Delete Pemilu
      $pemilu->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      foreach ($request->post('ids') as $item) {
        Pemilu::find($item)->delete();
      }
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
