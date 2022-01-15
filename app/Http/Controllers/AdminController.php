<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class AdminController extends Controller
{
    public function loginPanel(){
        
    }
    public function dashboard(){
        $employees = Employee::all();
        $i=1;
        return view('datatable',compact('employees','i'));
    }
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
        $data['password']= bcrypt($data['password']);
        $employee = Employee::create($data);
        auth()->login($employee);
        return redirect()->route('dashboard')->with('success','your account has been created');
    }
    public function show($id){
        $data = Employee::find($id);
        return view('editEmployee',compact('data'));
    }
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
        $edit->save();
        return redirect()->route('dashboard')->with('success','your account has been updated');
    }
    public function delete($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('dashboard')->with('success','this account has been deleted');
    }
}
