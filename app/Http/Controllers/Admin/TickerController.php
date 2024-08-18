<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticker;
use App\Helpers\AdminHelper;

class TickerController extends Controller
{
    public function index()
    {
        $ticker = Ticker::get();
        return view('admin.ticker.index',['ticker'=>$ticker]);
    }

    public function create()
    {
        return view('admin.ticker.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'counter'      => 'required',
            'tag'      => 'max:20',
            'description'      => 'required|max:100',
        ];

        $request->validate($rules);

        $data = [
            'counter'=>$request->counter,
            'tag'=>$request->tag,
            'description'=>$request->description,
            'status'=>$request->status
        ];

        Ticker::create($data);

        return redirect()->route('admin.ticker.index')->with('success', 'Ticker created successfully');
    }

    public function edit(Ticker $ticker)
    {
        return view('admin.ticker.edit', ['ticker'=>$ticker]);
    }

    public function update(Request $request, Ticker $ticker)
    {
        $rules = [
            'counter'      => 'required',
            'tag'      => 'max:20',
            'description'      => 'required|max:100',
        ];

        $request->validate($rules);
        $data = [
            'counter'=>$request->counter,
            'tag'=>$request->tag,
            'description'=>$request->description,
            'status'=>$request->status
        ];

        $ticker->update($data);
        return redirect()->route('admin.ticker.index')->with('success', 'Ticker updated successfully');
    }

    public function status_update(Ticker $ticker)
    {
        $ticker->update(['status'=>$ticker->status?0:1]);
        return redirect()->route('admin.ticker.index')->with('success', 'Ticker updated successfully');
    }

    public function delete(Ticker $ticker)
    {
        $ticker->delete();
        return redirect()->route('admin.ticker.index')->with('success', 'Ticker deleted successfully');
    }
}
