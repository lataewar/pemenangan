<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
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
   * @return array
   */
  public function rules()
  {
    // if edit without changing password
    if (isset(request()->r_type) && !request()->password) {
      return [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email, ' . request()->id . ',id',
        'role_id' => 'required',
      ];
    }

    return [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email, ' . request()->id . ',id',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'role_id' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'role_id.required' => 'Role is required.',
    ];
  }
}
