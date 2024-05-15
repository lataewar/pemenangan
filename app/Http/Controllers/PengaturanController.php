<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanController extends Controller
{
  public function index()
  {
    // dd(Pengaturan::first());
    return view('pengaturan.index', ['data' => Pengaturan::find(1)]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'target_persentase' => ['required', 'integer', 'min:0', 'max:100'],
    ]);

    $query = $request->id ? Pengaturan::first()->update($validated) : Pengaturan::create($validated);

    if ($query) Alert::success('Sukses', 'Pengaturan tersimpan.');

    return redirect()->route('pengaturan.index');
  }
}
