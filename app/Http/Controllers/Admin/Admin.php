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
            'vaccination' => 'required',
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
            'family_code' => $familyCode,
            'vaccine' => $request->vaccination,
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
            case "Family code":
                $option = 'family_code';
                break;
            case "Last Name":
                $option = 'last_name';
                break;
            case "First Name":
                $option = 'first_name';
                break;
            case "Middle Name":
                $option = 'middle_name';
                break;
            case "sex":
                if($request->text == 'Male' || $request->text == 'Female'){
                    $option = 'sex';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "Male" or "Female"']);
            case "age":
                if(ctype_alpha($request->text) == false){
                    $option = 'age';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be ( DIGITS )']);
            case "Birth Date":
                if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$request->text)) {
                    $option = 'birth_date';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Format should be "YYYY-MM-DD"']);
            case "Birth Place":
                $option = 'birth_place';
                break;
            case "Catrgory Type":
                if($request->text == 'SENIOR CITIZENS' || $request->text == 'WORKING' || $request->text == 'NON-WORKING'|| $request->text == 'MINOR'){
                    $option = 'category_type';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "SENIOR CITIZENS|WORKING|NON-WORKING or MINOR"']);
            case "Catrgory Status":
                if($request->text == 'PWD' || $request->text == '4PS' || $request->text == '4PS/PWD'|| $request->text == 'N/A'){
                    $option = 'category_status';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "PWD|4PS|4PS/PWD" or N/A"']);
            case "Civil Status":
                if($request->text == 'Single' || $request->text == 'Maried' || $request->text == 'Divorced'|| $request->text == 'Widowed'){
                    $option = 'civil_status';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "Single|Maried|Divorced or Widowed"']);
            case "Occupation":
                $option = 'occupation';
                break;
            case "Vaccine Status":
                if($request->text == 'Unvaccinated' || $request->text == 'Partially Vaccinated' || $request->text == 'Fully Vaccinated' || $request->text === 'Fully Vaccinated with Booster 1' || $request->text == 'Fully Vaccinated With Booster 2'){
                    $option = 'vaccine';
                    break;
                }
                return response()->json(['status' => 500, 'message' => 'Should be "Unvaccinated|Partially Vaccinated|Fully Vaccinated|Fully Vaccinated With Booster 1 or Fully Vaccinated with Booster 2"']);
        }

        $update = Residents::where('id', $request->index)->update(array($option => $request->text));
        if($update){
            return response()->json(['status' => 200, 'message' => $request->category . ' updated.']);
        }else{
            return response()->json(['status' => 500, 'message' => 'An Error Occurred.']);
        }
        
    }
}
