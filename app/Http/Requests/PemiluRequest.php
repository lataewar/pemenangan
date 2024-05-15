<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemiluRequest extends FormRequest
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
      'tps_id' => ['required', 'unique:pemilus,tps_id, ' . request()->id . ',id'],
      'jml_dpt' => ['int', 'required'],
      'jml_suara' => ['int', 'required'],
      'jml_suara_batal' => ['int', 'required'],
      'suara.*' => ['int', 'required'],
    ];
  }

  protected function prepareForValidation()
  {
    $suara = [];
    foreach ($this->suara as $key => $value) {
      $suara[$key] = str_replace(".", "", $value);
    }

    $this->merge([
      'jml_dpt' => str_replace(".", "", $this->jml_dpt),
      'jml_suara' => str_replace(".", "", $this->jml_suara),
      'jml_suara_batal' => str_replace(".", "", $this->jml_suara_batal),
      'suara' => $suara,
    ]);
  }

  public function messages()
  {
    return [
      'tps_id.unique' => 'TPS duplikat',
    ];
  }
}
