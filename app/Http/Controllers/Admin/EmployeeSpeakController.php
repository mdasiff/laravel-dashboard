<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{EmployeeSpeak};
use App\Helpers\AdminHelper;

class EmployeeSpeakController extends Controller
{
    public function index()
    {
        $employee_speaks = EmployeeSpeak::get();
        return view('admin.employee_speak.index',compact('employee_speaks'));
    }

    public function create()
    {   
        return view('admin.employee_speak.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'designation' => 'max:100',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3048'
        ];

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,

            'sort' => $request->sort,
            'status' => $request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, \Str::slug($request->name), 'employee-speaks');
        }

        EmployeeSpeak::create($data);

        return redirect()->route('admin.employee-speak.index')->with('success', 'Employee Speak created successfully');
    }

    public function edit(EmployeeSpeak $employee_speak)
    {
        return view('admin.employee_speak.edit', compact('employee_speak'));
    }

    public function update(Request $request, EmployeeSpeak $employee_speak)
    {
        $rules = [
            'name' => 'required|max:50',
            'designation' => 'max:100',
            'description' => 'required',
        ];

        if($request->hasFile('image') and !empty($request->image))
        {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:3048';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,

            'sort' => $request->sort,
            'status' => $request->status
        ];

        if($request->hasFile('image') and !empty($request->image)){
            $data['image'] = AdminHelper::upload_image($request, \Str::slug($request->name), 'employee-speaks');
        }

        $employee_speak->update($data);

        return redirect()->route('admin.employee-speak.index')->with('success', 'Employee Speak updated successfully');
    }

    public function status_update(EmployeeSpeak $employee_speak) {
        if($employee_speak->status == 1) {
            $employee_speak->status = 0;
        } else {
            $employee_speak->status = 1;
        }
        $employee_speak->save();
        return back()->with('success','Employee Speak updated successfully.');
    }

    public function delete(EmployeeSpeak $employee_speak) {
        $employee_speak->delete();
        return back()->with('success','Employee Speak delete successfully.');
    }

}
