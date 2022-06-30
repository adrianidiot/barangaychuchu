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
            'categoryStatus' => 'required',
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
            'category_status' => $request->categoryStatus,
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

    // public function Fourpis(){
    //     $residents = $this->getResidents('4PS');
    //     return view('admin.pages.four-pis', compact('residents'));
    // }

    // public function pwd(){
    //     $residents = $this->getResidents('PWD');
    //     return view('admin.pages.pwd', compact('residents'));
    // }

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

    // delete resident
    public function deleteResidents($id){
        $delete = Residents::where('id', intval($id))->delete();
        if($delete){
            return back()->with('message', 'Resident deleted.');
        }
    }

    //
    public function updateResident(Request $request){
        switch ($request->category) {
            case "code":
                if(is_int($request->text) || strlen((string)abs($request->text)) == 5){
                    $option = 'family_code';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "Male" or "Female"']);
            case "last":
                $option = 'last_name';
                break;
            case "first":
                $option = 'first_name';
                break;
            case "middle":
                $option = 'middle_name';
                break;
            case "sex":
                if($request->text == 'Male' || $request->text == 'Female'){
                    $option = 'sex';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "Male" or "Female"']);
            case "age":
                $option = 'age';
                break;
            case "date":
                $option = 'birth_date';
                break;
            case "place":
                $option = 'birth_place';
                break;
            case "type":
                $option = 'category_type';
                break;
            case "catStatus":
                $option = 'category_status';
                break;
            case "status":
                $option = 'civil_status';
                break;
            case "occu":
                $option = 'occupation';
                break;
        }

        $update = Residents::where('id', $request->index)->update(array($option => $request->text));
        if($update){
            return response()->json(['status' => 200, 'message' => $request->category . ' updated.']);
        }else{
            return response()->json(['status' => 500, 'message' => 'An Error Occurred.']);
        }
        
    }
}
