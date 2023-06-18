<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestUpdateRequest extends FormRequest
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
            'id_quest' => 'required|exists:App\Models\Quest',
            'quest' => 'required',
            'quest_type_id' => 'required|exists:App\Models\QuestType,id_quest_type',
            'target' => 'required|in:0,1,2'
        ];
    }
}
