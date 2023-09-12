<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUrgentParticipant extends FormRequest
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
            'training_id' => ['required', 'exists:trainings,id'],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email:filter', 'string'],
            'agency' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi'
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'Nama Lengkap',
            'email' => 'Alamat email',
            'agency' => 'Nama Instansi',
        ];
    }
}
