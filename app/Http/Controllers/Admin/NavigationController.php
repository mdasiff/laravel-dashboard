<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Navigation;
use Validator; 

class NavigationController extends Controller
{
    public function index() {
        $navigations = Navigation::get();
        return view('admin.navigation.index', ['navigations' => $navigations]);
    }

    public function create() {
        $main_menu_items = Navigation::where('parent_id', '=', 0)->get();
        $level1_menu_items = Navigation::where('level', '=', 1)->get();
        return view('admin.navigation.create',compact('main_menu_items', 'level1_menu_items'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'level' =>  'required',
            'file'   => 'mimes:pdf',
            'status'   => 'required',
        ]);
        
        $file = '';
        if($request->has('file')) {
            $file = \Str::slug($request->name).'-'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads/navigation'), $file);
        }
        $parent_id = 0;
        $main_menu_id = 0;
        if($request->level == 1) {
            $parent_id = $request->level_main;
        } else if($request->level == 2) {
            $parent_id = $request->level_1;
            $main_menu_id = $request->level_main;
        }

        $data = [
            'parent_id' => $parent_id,
            'main_menu_id' => $main_menu_id,
            'name' => $request->name,
            'type' => $request->type,
            'file' => $file,
            'link' => \Str::slug($request->link),
            'status' => $request->status==1?1:0,
            'sort' => $request->sort,
            'level' => $request->level,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
            'meta_tag_description'=>$request->meta_tag_description,
        ];

        Navigation::create($data);

        return redirect()->route('admin.navigation.index')->with('success','Navigation created successfully.');
    }

    public function edit(Navigation $navigation) {
        $main_menu_items = Navigation::where('parent_id', '=', 0)->get();
        $level1_menu_items = Navigation::where('parent_id', '=', $navigation->main_menu_id)->get();
        return view('admin.navigation.update',compact('navigation', 'main_menu_items', 'level1_menu_items'));
    }

    public function update(Navigation $navigation, Request $request) {
        $validated = $request->validate([
            'level' =>  'required',
            'file'   => 'mimes:pdf',
            'status'   => 'required',
        ]);
        
        $file = '';
        if($request->has('file')) {
            $file = \Str::slug($request->name).'-'.time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads/navigation'), $file);
        }
        $parent_id = 0;
        if($request->level == 1) {
            $parent_id = $request->level_main;
        } else if($request->level == 2) {
            $parent_id = $request->level_1;
        }

        $data = [
            'parent_id' => $parent_id,
            'name' => $request->name,
            'type' => $request->type,
            'file' => $file,
            'link' => \Str::slug($request->link),
            'status' => $request->status==1?1:0,
            'sort' => $request->sort,
            'level' => $request->level,
            'meta_tag_title'=>$request->meta_tag_title,
            'meta_tag_keywords'=>$request->meta_tag_keywords,
            'meta_tag_description'=>$request->meta_tag_description,
        ];

        $navigation->update($data);

        return back()->with('success','Navigation updated successfully.');
    }

    public function status_update(Navigation $navigation) {
        if($navigation->status == 1) {
            $navigation->status = 0;
        } else {
            $navigation->status = 1;
        }
        $navigation->save();
        return back()->with('success','Navigation updated successfully.');
    }

    public function get_level_1_list(Request $request) {
        $level1_menu_items = Navigation::where('parent_id', '=', $request->val)->get();
        $data = '';
        foreach($level1_menu_items as $level1_menu_item) {
            $data.= '<option value="'.$level1_menu_item->id.'">'.$level1_menu_item->name.'</option>';
        }
        return $data;
    }

    public function delete(Navigation $navigation) {
        $navigation->delete();
        return back()->with('success','Navigation deleted successfully.');
    }

}
