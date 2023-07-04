<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaskesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'faskes_name' => $this->faskes_name,
            'faskes_id' => $this->id_faskes,
            'faskes_type' => $this->faskes_type_id,
            'faskes_establish' => $this->faskes_establish,
            'fullname' => $this->user->fullname,
            'district' => $this->district_id,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'user_id' => $this->user->id_user,
        ];
    }
}
