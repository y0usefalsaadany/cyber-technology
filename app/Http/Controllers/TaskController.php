<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        return view('index');
    }
    public function tasks(){
        if (session()->has('loginId')){
            $tasks = Task::paginate();
            $i = 1;
            return view('tasks',compact('tasks','i'));
        }else{
            return view("logindashboard");
        }
    }
    public function store(){
        $data = request()->validate([
            'name'=>'required|min:3|max:50',
            'project'=>'required|min:3|max:50',
            'description'=>'required|min:3|max:255',
            'whatsapp'=>'required|min:11|max:15',
        ]);
        $task = Task::create($data);
        return redirect()->route('home')->with('success','Your order has been sent. Thank you!');
    }
    public function destroy($id){
        $data = Task::find($id);
        $data->delete();
        return redirect()->route('tasks')->with('success','this order has been done');
    }
}
