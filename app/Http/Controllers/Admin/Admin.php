<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Residents;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class Admin extends Controller
{
    public function addFamily($id){
        $familyId = $id;
        
        return view('admin.add-family', compact('familyId'));
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
            'occupation' => 'required',
        ]);
        if($request->code){
            $famCode = $request->lastName . '-' . $request->code;
            dd(strtolower($famCode));
            $hasFamilyCode = Residents::where('family_code', strtolower($famCode))->count();
            if($hasFamilyCode > 0){
                $familyCode = $famCode;
            }else{
                $familyCode = $famCode;
            }
        }else{
            $familyCode = $request->lastName . '-' . rand(10000,99999);
        }
        

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
            'family_code' => $familyCode
        ));

        if($storeResidents){
            return back()->with('message', $request->firstName . ' ' . $request->lastName . ' successfully added.');
        }

    }
}
