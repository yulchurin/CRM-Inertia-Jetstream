<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $fillable = [
        'name',
        'address',
    ];

    protected $spatialFields = [
        'location',
    ];
}
