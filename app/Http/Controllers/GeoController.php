<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Province;


class GeoController extends Controller
{
    public function provinces(Region $region)
    {
        return $region->provinces()->orderBy('name')->get(['id','name','code']);
    }

    public function cities(Province $province)
    {
        return $province->cities()->orderBy('name')->get(['id','name']);
    }
}