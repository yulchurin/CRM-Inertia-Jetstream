<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isOwner();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [//TODO
            'name',
            'short_name',
            'phone',
            'email',
            'zip',
            'region',
            'city',
            'street',
            'house',
            'office',
            'OGRN',
            'INN',
            'KPP',
            'bank_BIC',
            'bank_name',
            'bank_account',
            'bank_corr_account',
            'manager_post',
            'manager_first_name',
            'manager_last_name',
            'manager_middle_name',
            'license_issuer',
            'license_number',
            'license_blank_series',
            'license_blank_number',
            'license_issuance_date',
        ];
    }
}
