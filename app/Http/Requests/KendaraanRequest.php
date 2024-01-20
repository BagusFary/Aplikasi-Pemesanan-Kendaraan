<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KendaraanRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $kendaraan_id = $this->input('id');
        return [
            'nama' => 'required|max:100',
            'plat' => 'required|max:15|unique:kendaraan,plat,'.$kendaraan_id,
            'konsumsi_bbm_per_km' => 'required',
            'jenis_kendaraan' => 'required',
            'kepemilikan' => 'required'
        ];
    }
}
