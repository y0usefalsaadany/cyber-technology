<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class SessionController extends Controller
{
    public function loginPanel(){
        if (session()->has('loginId')){
            return redirect('admin-panel');
        }else{
            return view("logindashboard");
        }
    }
    public function dashboard(){
        if (!session()->has('loginId')){
            $employees = Employee::all();
            $i=1;
            return view('datatable',compact('employees','i'));
        }else{
            return redirect('loginAdmin');
        }
    }

    public function deleteSession(){
        session()->forget('loginId');
        return redirect('loginAdmin');
    }
}
