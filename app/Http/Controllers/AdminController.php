<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Session;
use Hash;

class AdminController extends Controller
{

    /*
    ***********************
    @this is login function
    ***********************
    */
    public function loginPanel(Request $req){
        $data =  request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $employee = Employee::where('email','=',$req->email)->first();
        if($employee){
            if(Hash::check($req->password, $employee->password)){
                if($employee->is_admin == 1){
                    $req->session()->put('loginId',$employee->id);
                    return redirect('admin-panel')->with('success','welcome '.$employee->name.' in dashboard');
                }else{
                    return redirect('loginAdmin')
                    ->with('failed','sorry you are not admin');
                }
            }else{
                return redirect('loginAdmin')
                ->with('failed','sorry this password is not correct');
            }
        }else{
            return redirect('loginAdmin')
            ->with('failed','sorry this email is not correct');
        }
    }


    /*
    ***********************
    @this is addEmployee function
    ***********************
    */

    public function addEmployee(){
        $data = request()->validate([
            'name'=>'required|min:3|max:25',
            'position'=>'required|min:3|max:25',
            'address'=>'required|min:3|max:25',
            'age'=>'required|min:1|max:2',
            'email'=>'required|email|unique:employees,email|min:10|max:50',
            'password'=>'min:7|max:25',
            'is_admin'=>'required|min:1|max:1'
        ]);
        $data['password']= Hash::make($data['password']);
        $employee = Employee::create($data);
        return redirect('admin-panel')->with('success','your account has been created');
    }

    /*
    ***********************
    @this is show Employee function
    ***********************
    */
    
    public function show($id){
        if (session()->has('loginId')){
            $data = Employee::find($id);
            return view('editEmployee',compact('data'));
        }else{
            return view("logindashboard");
        }
    }

/*
    ***********************
    @this is update function
    ***********************
    */

    public function update($id){
        $edit = Employee::find($id);
        $data = request()->validate([
            'name'=>'required|min:3|max:25',
            'position'=>'required|min:3|max:25',
            'address'=>'required|min:3|max:25',
            'age'=>'required|min:1|max:2',
            'email'=>'required|email|unique:employees,email|min:10|max:50',
            'is_admin'=>'required|min:1|max:1'
        ]);
        $edit->update($data);
        return redirect('admin-panel')->with('success','your account has been updated');
    }


/*
    ***********************
    @this is delete function
    ***********************
    */

    public function delete($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect('admin-panel')->with('success','this account has been deleted');
    }
}
