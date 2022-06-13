<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Residents;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function addFamily(){
        return view('admin.add-family');
    }

    public function addResident(){
        return view('admin.add-resident');
    }

    public function storeResident(Request $request){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'categoryType' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'birthDate' => 'required',
            'birthPlace' => 'required',
            'civilStatus' => 'required',
            'occupation' => 'required'
        ]);

        $storeResidents = Residents::create(array(
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'middle_name' => $request->middleName,
            'category_type' => $request->categoryType,
            'sex' => $request->sex,
            'age' => $request->age,
            'birth_date' => $request->birthDate,
            'birth_place' => $request->birthPlace,
            'civil_status' => $request->civilStatus,
            'occupation' => $request->occupation,
        ));

        if($storeResidents){
            return back()->with('message', 'oyieh');
        }

    }
}
