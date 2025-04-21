<?php

namespace App\Http\Requests\Function;

use Illuminate\Foundation\Http\FormRequest;

class TarifRequest extends FormRequest
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
        return [
            'jenis_plg' => 'required|string|unique:tarifs,jenis_plg,' . $this->tarif,
            'biaya_beban' => 'required|numeric|min:0',
            'tarif_kwh' => 'required|numeric|min:0',
            // 'jenis_plg' => 'required|exists:jenis,id',
        ];
    }
}
