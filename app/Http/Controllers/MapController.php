<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kampus;
use App\Models\Gedung;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\SebaranFakultas;
use App\Models\WilayahKampus;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public static function stAsGeoJsonLatLng(){
        return DB::raw('st_asgeojson(latlng) as area');
    }

    public function polygonTextGedung()
    {
        $data = Gedung::select(DB::raw('AsText(latlng) as polyText'))->get();
        return $data;
    }

    public function resultKampus()
    {
        $idKampus = Kampus::where('nama_kampus', 'Universitas Negeri Surabaya')->first();
        $data =  WilayahKampus::select('*', $this->stAsGeoJsonLatLng())->where('id_kampus', $idKampus->id)->get();
        return $data;
    }

    public function resultFakultas()
    {
        $data =  SebaranFakultas::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultJurusan()
    {
        $data =  Jurusan::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultGedung()
    {
        $data =  Gedung::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultProdi()
    {
        $data =  Prodi::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }
}
