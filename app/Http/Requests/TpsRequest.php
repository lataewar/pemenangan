<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TpsRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required',
      'kabupaten_id' => 'required',
      'kecamatan_id' => 'required',
      'kelurahan_id' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Nama harus diisi.',
      'kabupaten_id.required' => 'Kabupaten/Kota harus diisi.',
      'kecamatan_id.required' => 'Kecamatan harus diisi.',
      'kelurahan_id.required' => 'Desa/Kelurahan harus diisi.',
    ];
  }
}
