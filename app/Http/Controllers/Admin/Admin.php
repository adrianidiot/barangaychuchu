<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function addFamily(){
        return view('admin.add-family');
    }

    public function addResident(){
        return view('admin.add-resident');
    }
}
