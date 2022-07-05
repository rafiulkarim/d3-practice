<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        return view('division');
    }

    public function div_geojson()
    {
        $locations = Division::with('division_geojson')->get();
        $original_data = json_decode($locations, true);

        $coordinates = array();
        foreach($original_data[0]['division_geojson'] as $key => $value) {
            $coordinates[] = array((double)$value['lat'], (double)$value['long']);
        }

        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => array(
                'type' => 'Feature',
                'geometry' => array('type' => 'Polygon', 'coordinates' => $coordinates),
                'properties' => array('name' => 'value'),
            ),
        );

        return json_encode($new_data);
    }

    public function geoJson($locations){
        $original_data = json_decode($locations, true);
        $coordinates = array();
        foreach($original_data as $key => $value) {
            $coordinates[] = array('lat' => $value['lat'], 'lon' => $value['long']);
        }
        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => array(
                'type' => 'Feature',
                'geometry' => array('type' => 'MultiPolygon', 'coordinates' => $coordinates),
                'properties' => array('name' => 'value'),
            ),
        );

        $final_data = json_encode($new_data, JSON_PRETTY_PRINT);
        return $final_data;
    }
}
