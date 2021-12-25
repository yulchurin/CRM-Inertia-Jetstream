<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Certificate Model
 *
 * @property int id
 * @property int user_id
 * @property int number
 * @property int final_grade
 */
class Certificate extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Certificate belongs to the User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
