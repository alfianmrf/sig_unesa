<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class SebaranFakultas extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $table = 'sebaran_fakultas';

    protected $spatialFields = [
        'latlng',
    ];
}
