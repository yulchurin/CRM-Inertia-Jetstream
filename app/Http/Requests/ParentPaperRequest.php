<?php

namespace App\Http\Requests;

use App\Models\Paper;
use App\Models\Student;
use App\Rules\SnilsValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentPaperRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $paper = Paper::find($this->id);

        return $this->user()->can('update', $paper) ||
            $this->user()->can('create', Paper::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'series' => 'required|digits:4',
            'number' => 'required|digits:6',
            'issuer' => 'required|string',
            'issuance_date' => 'required|date',
        ];
    }
}
