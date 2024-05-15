<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\DtHelper;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables as DataTables;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('isajaxreq')->except('index');
  }

  public function index()
  {
    return User::with('role')->get();

    return view('user.index');
  }

  public function dt()
  {
    if (request()->type == 'table') {
      return json_encode([
        'data' => view('user.table')->render()
      ]);
    }

    $data = User::with('role')->get();

    return DataTables::of($data)
      ->addColumn('aksi', function ($data) {
        return DtHelper::editBtn($data->id) . DtHelper::deleteBtn($data->id, $data->name);
      })
      ->addColumn('role', function ($data) {
        return $data->role->name;
      })
      ->addColumn('dibuat', function ($data) {
        return $data->created_at->isoFormat('dddd, D MMMM Y');
      })
      ->addColumn('cb', function ($data) {
        return DtHelper::checkBox($data->id);
      })
      ->rawColumns(['aksi', 'cb', 'role', 'dibuat'])
      ->make();
  }

  public function create()
  {
    return json_encode([
      'data' => view('user.create', [
        'roles' => Role::get()
      ])->render()
    ]);
  }

  public function store(UserRequest $request)
  {
    try {
      // Create new User
      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
      ]);

      return response()->json(['sukses' => 'Data berhasil ditambahkan.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function edit(User $user)
  {
    return json_encode([
      'data' => view('user.edit', [
        'data' => $user,
        'roles' => Role::get()
      ])->render()
    ]);
  }

  public function update(UserRequest $request, User $user)
  {
    try {
      $data = [];

      // if edit without changing password
      if (isset(request()->r_type) && !request()->password) {
        $data = [
          'name' => $request->name,
          'email' => $request->email,
          'role_id' => $request->role_id,
        ];
      } else {
        // if edit and changing password
        $data = [
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'role_id' => $request->role_id,
        ];
      }

      // Update User
      $user->update($data);

      return response()->json(['sukses' => 'Data berhasil diubah.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function destroy(User $user)
  {
    try {
      // Delete User
      $user->delete();
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
      //
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      User::whereIn('id', $request->post('ids'))->delete();
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
