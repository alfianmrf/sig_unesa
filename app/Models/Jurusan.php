<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Jurusan extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $table = 'jurusan';

    protected $spatialFields = [
        'latlng',
    ];
}
