<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Models\Menu;
use App\Helpers\DtHelper;
use App\Http\Requests\SubMenuRequest;
use Yajra\DataTables\DataTables as DataTables;

class SubMenuController extends Controller
{
  public function __construct()
  {
    // $this->middleware('isajaxreq')->except('index');
  }

  public function index(Menu $menu)
  {
    $routes = [
      ['name' => 'Menu', 'route' => route('menu.index')],
      ['name' => 'Sub Menu', 'route' => route('submenu.index', ['menu' => $menu->id])],
    ];
    return view('submenu.index', ['id' => $menu->id, 'routes' => $routes]);
  }

  public function dt(Menu $menu)
  {
    // dd('in');
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('submenu.table')->render()
      ]);
    }

    $data = $menu->subMenus;

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtn($data->id) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi'])
      ->make();
  }

  public function create($menu)
  {
    return json_encode([
      'data' => view('submenu.create', ['menu' => $menu])->render()
    ]);
  }

  public function store($menu, SubMenuRequest $request)
  {
    try {
      // Create new SubMenu
      SubMenu::create($request->all() + ['menu_id' => $menu]);

      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function edit($menu, SubMenu $submenu)
  {
    return json_encode([
      'data' => view('submenu.edit', [
        'menu' => $menu,
        'data' => $submenu
      ])->render()
    ]);
  }

  public function update($menu, SubMenuRequest $request, SubMenu $submenu)
  {
    // dd($request->all());
    try {
      // Update SubMenu
      $submenu->update($request->all());

      return response()->json(['sukses' => 'Data berhasil diubah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function destroy($menu, SubMenu $submenu)
  {
    try {
      // Delete Menu
      $submenu->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
