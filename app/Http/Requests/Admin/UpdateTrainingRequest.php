<?php

namespace App\Http\Requests\Admin;

use App\Enums\TrainingTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateTrainingRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' =>  ['nullable', 'image', 'mimes:jpg,png', 'max:512'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'place' => ['required', 'string'],
            'type' => ['required', new Enum(TrainingTypeEnum::class)],
            'quota' => ['required', 'numeric'],
            'trainer_id' => ['required', 'numeric', 'exists:trainers,id'],
            'price_earlybird' => ['required', 'numeric'],
            'earlybird_end' => ['required', 'date'],
            'price_normal' => ['required', 'numeric'],
            'price_onsite' => ['required', 'numeric'],
        ];
    }
}
