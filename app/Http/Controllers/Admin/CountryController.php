<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Helpers\AdminHelper;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::get();
        return view('admin.country.index',compact('countries'));
    }

    public function create()
    {   
        return view('admin.country.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);  

        $data = [
            'name' => $request->name
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, null, 'country');
        }

        Country::create($data);

        return redirect()->route('admin.country.index')->with('success','Country created successfully.');
        
    }

    public function edit(Country $country) {
        return view('admin.country.update', compact('country'));
    }

    public function update(Country $country, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);  

        $data = [
            'name' => $request->name
        ];

        if($request->has('image'))
        {
            $data['image'] = AdminHelper::upload_image($request, null, 'country');
        }

        $country->update($data);

        return redirect()->route('admin.country.index')->with('success','Country updated successfully.');
        
    }

    public function status_update(Country $country) {
        if($country->status == 1) {
            $country->status = 0;
        } else {
            $country->status = 1;
        }
        $country->save();
        return back()->with('success','Country status updated successfully.');
    }

    public function delete(Country $country) {
        $country->delete();
        return back()->with('success','Location deleted successfully.');
    }
}
