<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\District;
use App\Models\Divission;
use App\Models\People;
use App\Models\Upazila;
use App\Models\User;
use App\Models\VaccinationCenter;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        People::factory(30)->create();


        $user = new User();
        $user->name = 'Rasel Ahmed';
        $user->email = 'demo@user.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123');
        $user->remember_token = Str::random(10);
        $user->save();



        // creating divisions
        foreach(tika_bd_divisions() as $division) {
            $divisionModel = new Divission();
            $divisionModel->name = $division['name'];
            $divisionModel->save();
        }


        // creating districts
        foreach(tika_bd_districts() as $district) {
            $districtModel = new District();
            $districtModel->name = $district['name'];
            $districtModel->division_id = $district['division_id'];
            $districtModel->save();
        }


        // creating upazilas
        foreach(tika_bd_upazilas() as $upazila) {
            $upazilaModel = new Upazila();
            $upazilaModel->name = $upazila['name'];
            $upazilaModel->district_id = $upazila['district_id'];
            $upazilaModel->save();
        }

        // creating categories
        foreach(tika_bd_categories() as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category['name'];
            $categoryModel->min_age = $category['min_age'];
            $categoryModel->save();
        }

        // creating vaccines
        $available_vaccines = ['Pfizer', 'Moderna', 'AstraZeneca', 'Sinopharm', 'Sputnik V'];
        foreach($available_vaccines as $available_vaccine) {
            $vaccine = new Vaccine();
            $vaccine->name = $available_vaccine;
            $vaccine->save();
        }

        VaccinationCenter::factory(30)->create();
    }
}
