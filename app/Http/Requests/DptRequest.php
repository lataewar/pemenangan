<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DptRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required',
      'nik' => 'required',
      'kabupaten_id' => 'required',
      'kecamatan_id' => 'required',
      'kelurahan_id' => 'required',
      'tps_id' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Nama harus diisi.',
      'nik.required' => 'NIK harus diisi.',
      'kabupaten_id.required' => 'Kabupaten/Kota harus diisi.',
      'kecamatan_id.required' => 'Kecamatan harus diisi.',
      'kelurahan_id.required' => 'Desa/Kelurahan harus diisi.',
      'tps_id.required' => 'TPS harus diisi.',
    ];
  }
}
