<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Company Model
 *
 * @property integer id
 * @property string name
 * @property string short_name
 * @property string phone
 * @property string email
 * @property string zip
 * @property string region
 * @property string city
 * @property string street
 * @property string house
 * @property string office
 * @property string OGRN
 * @property string INN
 * @property string KPP
 * @property string bank_BIC
 * @property string bank_name
 * @property string bank_account
 * @property string bank_corr_account
 * @property string manager_post
 * @property string manager_first_name
 * @property string manager_last_name
 * @property string manager_middle_name
 * @property string license_issuer
 * @property string license_number
 * @property string license_blank_series
 * @property string license_blank_number
 * @property Carbon license_issuance_date
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'company';
    protected $dates = ['license_issuance_date'];

    protected $fillable = [
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
