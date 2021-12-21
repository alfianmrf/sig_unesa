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
    public function index(){
        $idKampus = Kampus::where('nama_kampus', 'Universitas Negeri Surabaya')->first();
        $kampus = WilayahKampus::select('*', $this->stAsGeoJsonLatLng())->where('id_kampus', $idKampus->id)->get();
        $fakultas = SebaranFakultas::select('*', $this->stAsGeoJsonLatLng())->get();
        $jurusan = Jurusan::select('*', $this->stAsGeoJsonLatLng())->get();
        $gedung = Gedung::select('*', $this->stAsGeoJsonLatLng())->get();
        $prodi = Prodi::select('*', $this->stAsGeoJsonLatLng())->get();

        return view('welcome')
            ->with('kampus', $kampus)
            ->with('fakultas', $fakultas)
            ->with('jurusan', $jurusan)
            ->with('gedung', $gedung)
            ->with('prodi', $prodi);
    }

    public static function stAsGeoJsonLatLng(){
        return DB::raw('st_asgeojson(latlng) as area');
    }

    public static function polygonTextGedung($id)
    {
        $data = Gedung::select(DB::raw('AsText(latlng) as polyText'))->where('id', $id)->get();
        return $data;
    }

    public static function polygonTextKampus($id)
    {
        $data = WilayahKampus::select(DB::raw('AsText(latlng) as polyText'))->where('id', $id)->get();
        return $data;
    }

    public static function polygonTextFakultas($id)
    {
        $data = SebaranFakultas::select(DB::raw('AsText(latlng) as polyText'))->where('id', $id)->get();
        return $data;
    }

    public static function polygonTextJurusan($id)
    {
        $data = Jurusan::select(DB::raw('AsText(latlng) as polyText'))->where('id', $id)->get();
        return $data;
    }

    public function resultKampus()
    {
        $idKampus = Kampus::where('nama_kampus', 'Universitas Negeri Surabaya')->first();
        $data = WilayahKampus::select('*', $this->stAsGeoJsonLatLng())->where('id_kampus', $idKampus->id)->get();
        return $data;
    }

    public function resultKampusFilter(Request $request)
    {
        $idKampus = Kampus::where('nama_kampus', 'Universitas Negeri Surabaya')->first();
        $data = WilayahKampus::select('*', $this->stAsGeoJsonLatLng())->where('id_kampus', $idKampus->id)->where('id', $request->id)->get();
        return $data;
    }

    public function resultFakultas()
    {
        $data = SebaranFakultas::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultFakultasFilter(Request $request)
    {
        $data = SebaranFakultas::select('*', $this->stAsGeoJsonLatLng())->where('id', $request->id)->get();
        return $data;
    }

    public function resultJurusan()
    {
        $data = Jurusan::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultJurusanFilter(Request $request)
    {
        $data = Jurusan::select('*', $this->stAsGeoJsonLatLng())->where('id', $request->id)->get();
        return $data;
    }

    public function resultGedung()
    {
        $data = Gedung::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultGedungFilter(Request $request)
    {
        $data = Gedung::select('*', $this->stAsGeoJsonLatLng())->where('id', $request->id)->get();
        return $data;
    }

    public function resultProdi()
    {
        $data = Prodi::select('*', $this->stAsGeoJsonLatLng())->get();
        return $data;
    }

    public function resultProdiFilter(Request $request)
    {
        $data = Prodi::select('*', $this->stAsGeoJsonLatLng())->where('id', $request->id)->get();
        return $data;
    }

    public function centerGedung(Request $request)
    {
        $data = array();
        foreach($this->polygonTextGedung($request->id) as $items){
            $pointText = $items['polyText'];
            $center = collect(DB::select('SELECT ST_AsText(ST_Centroid(ST_GeomFromText("'.$pointText.'"))) AS center'))->first();
            $centerPointCoordinate = collect(DB::select('SELECT ST_X(GeomFromText("'.$center->center.'")) as xValue, ST_Y(GeomFromText("'.$center->center.'")) as yValue'))->first();
            array_push($data, $centerPointCoordinate);
        }
        return $data;
    }

    public function centerKampus(Request $request)
    {
        $data = array();
        foreach($this->polygonTextKampus($request->id) as $items){
            $pointText = $items['polyText'];
            $center = collect(DB::select('SELECT ST_AsText(ST_Centroid(ST_GeomFromText("'.$pointText.'"))) AS center'))->first();
            $centerPointCoordinate = collect(DB::select('SELECT ST_X(GeomFromText("'.$center->center.'")) as xValue, ST_Y(GeomFromText("'.$center->center.'")) as yValue'))->first();
            array_push($data, $centerPointCoordinate);
        }
        return $data;
    }

    public function centerFakultas(Request $request)
    {
        $data = array();
        foreach($this->polygonTextFakultas($request->id) as $items){
            $pointText = $items['polyText'];
            $center = collect(DB::select('SELECT ST_AsText(ST_Centroid(ST_GeomFromText("'.$pointText.'"))) AS center'))->first();
            $centerPointCoordinate = collect(DB::select('SELECT ST_X(GeomFromText("'.$center->center.'")) as xValue, ST_Y(GeomFromText("'.$center->center.'")) as yValue'))->first();
            array_push($data, $centerPointCoordinate);
        }
        return $data;
    }

    public function centerJurusan(Request $request)
    {
        $data = array();
        foreach($this->polygonTextJurusan($request->id) as $items){
            $pointText = $items['polyText'];
            $center = collect(DB::select('SELECT ST_AsText(ST_Centroid(ST_GeomFromText("'.$pointText.'"))) AS center'))->first();
            $centerPointCoordinate = collect(DB::select('SELECT ST_X(GeomFromText("'.$center->center.'")) as xValue, ST_Y(GeomFromText("'.$center->center.'")) as yValue'))->first();
            array_push($data, $centerPointCoordinate);
        }
        return $data;
    }
}
