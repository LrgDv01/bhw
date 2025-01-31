<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\MapModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MapController extends Controller
{
    public function get_map_locations() {
        $map_loc = MapModel::all();
        $locations = [];
        foreach ($map_loc as $loc) {
            $locations[] = [
                'name' => $loc->name,
                'population' => $loc->population,
                'women' => $loc->women,
                'child' => $loc->child,
            ];
        }
        $res = [
            'locations' => $locations,
        ];
        return response()->json($res);
    }
}
    