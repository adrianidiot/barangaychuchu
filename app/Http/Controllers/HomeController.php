<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $generatedFamilyId = rand(10000,99999);
        $residents = Residents::orderBy('id', 'DESC')->get();

        $working = Residents::where('category_type', 'WORKING')->count();
        $nonWorking = Residents::where('category_type', 'NON-WORKING')->count();
        $fourPs = Residents::where('category_type', '4PS')->count();
        $pwds = Residents::where('category_type', 'PWD')->count();
        $minors = Residents::where('category_type', 'MINOR')->count();
        $seniorCitizens = Residents::where('category_type', 'SENIOR CITIZENS')->count();

        $users = Residents::select('id', 'created_at')
                ->get()
                ->groupBy(function($date) {
                    //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                    return Carbon::parse($date->created_at)->format('m'); // grouping by months
                });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }

        return view('home', compact(['residents','generatedFamilyId', 'working', 'nonWorking', 'fourPs', 'pwds', 'minors', 'seniorCitizens', 'userArr']));
    }
}
