<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Services\AppointmentLimitations;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $appointment = Appointment::find($this->id);

        return (! AppointmentLimitations::all()) &&
            ($this->user()->id === $appointment->student_id
                || $appointment->student_id === null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'place' => 'required|numeric',
            'comment' => 'string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'place.required' => 'Пожалуйста, выберитие место встречи',
        ];
    }
}
