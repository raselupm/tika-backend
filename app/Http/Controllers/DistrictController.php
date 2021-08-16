<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::paginate();
        return view('districts.index', ['districts' => $districts]);
    }
}
