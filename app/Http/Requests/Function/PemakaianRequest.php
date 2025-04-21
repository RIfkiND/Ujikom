<?php

namespace App\Http\Requests\Function;

use Illuminate\Foundation\Http\FormRequest;

class PemakaianRequest extends FormRequest
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
        'no_kontrol' => 'required|exists:pelanggans,no_kontrol',
        'tahun' => 'required|integer',
        'bulan' => [
            'required',
            'integer',
            'between:1,12',
            function ($attribute, $value, $fail) {
                $previousMonth = \App\Models\Pemakaian::where('no_kontrol', $this->no_kontrol)
                    ->where('bulan', $value - 1)
                    ->where('tahun', $this->tahun)
                    ->first();

                if (!$previousMonth && $value != 1) {
                    $fail('Pemakaian untuk bulan sebelumnya belum diinput. Harap input bulan sebelumnya terlebih dahulu.');
                }
            },
        ],
        'meter_awal' => 'required|integer|min:0',
        'meter_akhir' => 'required|integer|gte:meter_awal',
    ];
}
public function messages(): array
{
    return [
        'no_kontrol.required' => 'No kontrol wajib diisi.',
        'no_kontrol.exists' => 'No kontrol tidak ditemukan.',
        'bulan.required' => 'Bulan wajib diisi.',
        'bulan.integer' => 'Bulan harus berupa angka.',
        'bulan.between' => 'Bulan harus antara 1 dan 12.',
        'meter_awal.required' => 'Meter awal wajib diisi.',
        'meter_awal.integer' => 'Meter awal harus berupa angka.',
        'meter_awal.min' => 'Meter awal tidak boleh kurang dari 0.',
        'meter_akhir.required' => 'Meter akhir wajib diisi.',
        'meter_akhir.integer' => 'Meter akhir harus berupa angka.',
        'meter_akhir.gte' => 'Meter akhir harus lebih besar atau sama dengan meter awal.',
    ];
}
}
