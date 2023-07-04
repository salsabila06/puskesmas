<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FaskesUpdateRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role_id == ROLE_DINAS;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'faskes_id' => 'required|exists:App\Models\Faskes,id_faskes',
            'user_id' => 'required|exists:App\Models\User,id_user',
            'fullname' => 'required|min:3',
            'username' => 'required|min:3|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'faskes_name' => 'required',
            'faskes_type' => 'required|exists:App\Models\FaskesType,id_faskes_type',
            'district' => 'required|exists:App\Models\District,id_district',
            'faskes_establish' => 'required|date',
        ];
    }
}
