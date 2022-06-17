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

    public function addNewResident(){
        return view('admin.add-new-resident');
    }
    
    public function addResidentExistingFamily(){
        return view('admin.add-existing-family');
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

    public function allResidents(){
        $residents = Residents::orderBy('id', 'DESC')->get();
        return view('admin.pages.all-residents', compact('residents'));
    }

    public function working(){
        $residents = $this->getResidents('WORKING');
        return view('admin.pages.working', compact('residents'));
    }

    public function NonWorking(){
        $residents = $this->getResidents('NON-WORKING');
        return view('admin.pages.non-working', compact('residents'));
    }

    public function Fourpis(){
        $residents = $this->getResidents('4PS');
        return view('admin.pages.four-pis', compact('residents'));
    }

    public function pwd(){
        $residents = $this->getResidents('PWD');
        return view('admin.pages.pwd', compact('residents'));
    }

    public function minors(){
        $residents = $this->getResidents('MINOR');
        return view('admin.pages.minors', compact('residents'));
    }

    public function seniorCitizen(){
        $residents = $this->getResidents('SENIOR CITIZENS');
        return view('admin.pages.senior-citizen', compact('residents'));
    }

    public function getResidents($category){
        return Residents::where('category_type', strtoupper($category))->orderBy('id', 'DESC')->get();
    }

}
