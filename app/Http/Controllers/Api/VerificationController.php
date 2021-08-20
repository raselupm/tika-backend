<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\People;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $data = [
            'success' => false,
            'message' => '',
            'people' => []
        ];


        if(empty($request->category_id)) {
            $data['message'] = 'Please select category';
        }

        if(empty($request->id_no)) {
            $data['message'] = 'Please input ID number';
        }

        if(empty($request->dob)) {
            $data['message'] = 'Please input date of birth';
        }

        //return $dob;
        $people = People::where('id_no', $request->id_no)->where('dob', $request->dob)->first();
        if(empty($people)) {
            $data['message'] = 'ID not found.';
        } else {
            // ID found! Check the category
            $category = Category::where('id', $request->category_id)->first();

            if(empty($category)) {
                $data['message'] = 'Category not found';
            } else {
                // check eligible age
                $current_age = tikaAgeDifference($people->dob);
                if($current_age >= $category->min_age) {
                    // start registration
                    if($people->registered) {
                        $data['message'] = 'You are already registered. ';
                    } else {
                        $data = [
                            'success' => true,
                            'message' => 'Fill your information below',
                            'people' => $people
                        ];
                    }
                } else {
                    $data['message'] = 'Minimum age for '.$category->name.' is ' . $category->min_age . '. Your current age is ' . $current_age;
                }
            }
        }

        return $data;
    }
}
