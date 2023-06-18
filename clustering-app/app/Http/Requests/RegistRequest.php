<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistRequest extends FormRequest
{

    // protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|min:3',
            'username' => 'required|min:3|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'faskes_name' => 'required',
            'faskes_type' => 'required',
            'district' => 'required|exists:App\Models\District,id_district',
            'password' => ['required', 'confirmed', Password::min(6)],
            'password_confirmation' => ['required'],
        ];
    }
}
