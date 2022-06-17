<?php

namespace App\Http\Controllers;

use App\Models\Residents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

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
        
        return view('home', compact(['residents','generatedFamilyId', 'working', 'nonWorking', 'fourPs', 'pwds', 'minors', 'seniorCitizens']));
    }
}
