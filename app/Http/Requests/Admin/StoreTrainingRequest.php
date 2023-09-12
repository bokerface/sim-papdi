<?php

namespace App\Http\Requests\Admin;

use App\Enums\CostEnum;
use App\Enums\TrainingTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTrainingRequest extends FormRequest
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
            'image' =>  ['required', 'image', 'mimes:jpg,png', 'max:512'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'place' => ['required', 'string'],
            'type' => ['required', new Enum(TrainingTypeEnum::class)],
            // 'cost' => ['required', new Enum(CostEnum::class)],
            'quota' => ['required', 'numeric'],
            'trainer_id' => ['required', 'numeric', 'exists:trainers,id'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            // optionals price field
            'price_earlybird' => ['required_if:cost,paid', 'numeric'],
            'earlybird_end' => ['required_if:cost,paid', 'date'],
            'price_normal' => ['required_if:cost,paid', 'numeric'],
            'price_onsite' => ['required_if:cost,paid', 'numeric'],
        ];
    }
}
