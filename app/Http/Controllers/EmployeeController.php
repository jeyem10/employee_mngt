<?php

namespace App\Http\Controllers;
use Illuminate\Support\Fascades\DB;
use Response;
use Illuminate\Http\Request;
use App\Models\employee;

class EmployeeController extends Controller
{
    
    public function index(){


        $employees = employee::get();

        return view('employees.index', compact('employees'));
    }

    public function create(){
        return view('employees.create');
    }

    public function store(Request $request){
        $request->validate([
            'lname' => 'required|max:255|string',
            'fname' => 'required|max:255|string',
            'midname' => 'required|max:255|string',
            'age' => 'required|integer',
            'address' => 'required|max:255|string',
            'zip' => 'required|integer'

        ]);
        employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Student added successfully.');

    }

    public function edit( int $id){
        $employees = employee::find($id);
        return view ('employees.edit',compact('employees'));
    }

    public function update(Request $request, int $id) {
        
            $request->validate([
                'fname' => 'required|max:255|string',
                'lname' => 'required|max:255|string',
                'midname' => 'required|max:255|string',
                'age' => 'required|integer',
                'address' => 'required|max:255|string',
                'zip' => 'required|integer',
                
            ]);
        
            employee::findOrFail($id)->update($request->all());
            return redirect ()->back()->with('status','Employee Updated Successfully!');
            
    }

    public function destroy(Request $request, int $id){
        $employees = employee::findOrFail($id);
        $employees->delete();
        return redirect ()->back()->with('status','Student Deleted');
    }
}
