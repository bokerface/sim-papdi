<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateSettingsRequest extends FormRequest
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
            'id' => ['required', 'exists:certificate_settings,id'],
            'file' =>  ['required', 'image', 'mimes:jpg,png'],
        ];
    }
}
