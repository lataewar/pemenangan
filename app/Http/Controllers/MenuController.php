<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Helpers\DtHelper;
use Yajra\DataTables\DataTables as DataTables;

class MenuController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return view('menu.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('menu.table')->render()
      ]);
    }

    $data = Menu::all();

    return DataTables::of($data)
      ->addColumn('has_submenu', function ($data) {
        return $data->has_submenu ? DtHelper::label("Ya") : DtHelper::label("Tidak", "warning");
      })
      ->addColumn('aksi', function ($data) {
        $hasSubmenu = $data->has_submenu ? DtHelper::btn("menu/submenu/" . $data->id, "Sub Menu") : "";
        return $hasSubmenu . DtHelper::editBtn($data->id) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi', 'has_submenu'])
      ->make();
  }

  public function create()
  {
    return json_encode([
      'data' => view('menu.create')->render()
    ]);
  }

  public function store(MenuRequest $request)
  {
    $has_submenu = $request->has_submenu ? true : false;

    try {
      // Create new Menu
      Menu::create($request->except('has_submenu') + ['has_submenu' => $has_submenu]);

      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function edit(Menu $menu)
  {
    return json_encode([
      'data' => view('menu.edit', [
        'data' => $menu
      ])->render()
    ]);
  }

  public function update(MenuRequest $request, Menu $menu)
  {
    $has_submenu = $request->has_submenu ? true : false;

    try {
      // Update Menu
      $menu->update($request->except('has_submenu') + ['has_submenu' => $has_submenu]);

      return response()->json(['sukses' => 'Data berhasil diubah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function destroy(Menu $menu)
  {
    try {
      // Delete Menu
      $menu->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
