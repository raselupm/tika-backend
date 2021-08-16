<?php

namespace App\Http\Controllers;

use App\Models\VaccinationCenter;
use Illuminate\Http\Request;

class VaccinationCenterController extends Controller
{
    public function index()
    {
        $vaccinationCenters = VaccinationCenter::paginate();
        return view('vaccination-centers.index', ['vaccinationCenters' => $vaccinationCenters]);
    }
}
