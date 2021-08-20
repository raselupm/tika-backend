<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Divission;
use App\Models\Upazila;
use App\Models\VaccinationCenter;
use Illuminate\Http\Request;

use Twilio\Rest\Client;

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
    public function upazilas(Request $request) {
        $upazilas = Upazila::where('enabled', 1)->where('district_id', $request->district_id)->get();
        return response()->json($upazilas);
    }
    public function vaccinationCenters(Request $request) {
        $centers = VaccinationCenter::where('enabled', 1)->where('upazila_id', $request->upazila_id)->get();
        return response()->json($centers);
    }


    public function phoneVerify(Request $request) {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create('+88' . $request->phone, "sms");

        return response()->json($verification->status);
    }
    public function phoneVerifyCode(Request $request) {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($request->verify_code, // code
                ["to" => "+88" . $request->phone]
            );

        return response()->json($verification->status);
    }
}
