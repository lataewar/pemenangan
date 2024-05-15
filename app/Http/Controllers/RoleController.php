<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Role;
use App\Helpers\DtHelper;
use App\Models\Menu;
use Yajra\DataTables\DataTables as DataTables;

class RoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return view('role.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('role.table')->render()
      ]);
    }

    $data = Role::all();

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::defaultBtn("akses", $data->id, "Akses", "General/Unlock.svg") .
          DtHelper::editBtn($data->id) .
          DtHelper::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi'])
      ->make();
  }

  public function akses(Role $role)
  {
    return json_encode([
      'data' => view('role.akses', [
        'data' => $role,
        'menus' => Menu::get()
      ])->render()
    ]);
  }

  public function aksesSync(Role $role)
  {
    try {
      // sync role menu
      $role->menus()->sync(request('menus'));

      return response()->json(['sukses' => 'Aksi sukses.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function create()
  {
    return json_encode([
      'data' => view('role.create')->render()
    ]);
  }

  public function store(MenuRequest $request)
  {
    try {
      // Create new Role
      Role::create($request->all());

      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function edit(Role $role)
  {
    return json_encode([
      'data' => view('role.edit', [
        'data' => $role
      ])->render()
    ]);
  }

  public function update(MenuRequest $request, Role $role)
  {
    try {
      // Update Role
      $role->update($request->all());

      return response()->json(['sukses' => 'Data berhasil diubah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function destroy(Role $role)
  {
    try {
      // Delete Role
      $role->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
