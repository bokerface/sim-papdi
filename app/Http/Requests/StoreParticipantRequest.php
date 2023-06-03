<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
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
            'fullname' => ['array', 'required'],
            'fullname.*' => ['string', 'required'],
            'email' => ['array', 'required'],
            'email.*' => ['email:filter', 'string']
        ];
    }
}
