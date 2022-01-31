<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Group::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:groups,title,' . $this->id,
            'start' => 'required|date',
            'end' => 'required|date',
            'base_price' => 'required|numeric|min:100000',
            'drive_hours' => 'numeric|min:0|max:255',
            'price_per_driving_hour' => 'required|numeric|min:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'price_per_driving_hour.min' => 'Введите цену с копейками',
            'base_price.min' => 'Введите цену с копейками (не менее 1000 р.)',
        ];
    }
}
