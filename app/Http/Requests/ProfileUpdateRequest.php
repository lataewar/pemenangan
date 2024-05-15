<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Nama harus diisi.',
      'name.string' => 'Nama harus berupa teks.',
      'email.required' => 'Email harus diisi.',
      'email.email' => 'Email harus berupa alamat email yang valid.',
      'email.unique' => 'Email ini sudah digunakan.',
    ];
  }
}
