<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Divission;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function divisions() {
        $divisions = Divission::where('enabled', 1)->get();

        return response()->json($divisions);
    }
    public function districts(Request $request) {


        $districts = District::where('enabled', 1)->where('division_id', $request->division_id)->get();

        return response()->json($districts);
    }
}
