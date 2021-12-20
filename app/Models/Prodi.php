<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Prodi extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $table = 'prodi';

    protected $spatialFields = [
        'latlng',
    ];
}
