<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Location, Country};
use App\Helpers\AdminHelper;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::get();
        return view('admin.location.index',compact('locations'));
    }

    public function create()
    {   
        $countries = Country::get();
        return view('admin.location.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'address_1' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'zip' => 'integer'
        ]);  

        $data = [
            'title' => $request->title,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'zip' => $request->zip,
            'city' => $request->city,
            'country_id' => $request->country_id,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'cin' => $request->cin,
            'status' => $request->status==1?1:0,
        ];

        Location::create($data);

        return redirect()->route('admin.locations.index')->with('success','Location created successfully.');
        
    }

    public function edit(Location $location) {
        $countries = Country::get();
        return view('admin.location.update', compact('location', 'countries'));
    }

    public function update(Location $location, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'address_1' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'country_id' => 'required',
            'zip' => 'integer'
        ]);  

        $data = [
            'title' => $request->title,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'zip' => $request->zip,
            'city' => $request->city,
            'country_id' => $request->country_id,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'cin' => $request->cin,
            'status' => $request->status==1?1:0,
        ];

        $location->update($data);

        return redirect()->route('admin.locations.index')->with('success','Location updated successfully.');
        
    }

    public function status_update(Location $location) {
        if($location->status == 1) {
            $location->status = 0;
        } else {
            $location->status = 1;
        }
        $location->save();
        return back()->with('success','Location status updated successfully.');
    }

    public function delete(Location $location) {
        $location->delete();
        return back()->with('success','Location deleted successfully.');
    }

}
