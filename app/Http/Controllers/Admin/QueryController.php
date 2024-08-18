<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    ContactQuery, WebinarQuery, ResourceQuery, CareerQuery
};


class QueryController extends Controller
{
    // public function index()
    // {
    //     $queries = Query::latest()->get();

    //     return view('admin.query.index',['queries'=>$queries]);
    // }

    public function resource()
    {
        $queries = ResourceQuery::latest()->limit(200)->get();
        return view('admin.query.resource',['queries'=>$queries]);
    }

    public function resource_delete(ResourceQuery $resource)
    {
        $resource->delete();

        return redirect()->route('admin.query.resourcq')->with('message', 'Query deleted successfully');
    }

    public function contact()
    {
        $queries = ContactQuery::latest()->limit(200)->get();
        return view('admin.query.contact',['queries'=>$queries]);
    }

    public function contact_delete(ContactQuery $contact_query)
    {
        $contact_query->delete();

        return back()->with('message', 'Query deleted successfully');
    }

    public function webinar()
    {
        $queries = WebinarQuery::latest()->limit(200)->get();
        return view('admin.query.webinar',['queries'=>$queries]);
    }

    public function career()
    {
        $queries = CareerQuery::latest()->limit(200)->get();
        return view('admin.query.career',['queries'=>$queries]);
    }

    public function career_delete(CareerQuery $career_query)
    {
        $career_query->delete();

        return back()->with('message', 'Query deleted successfully');
    }

    public function webinar_delete(WebinarQuery $webinar_query)
    {
        $webinar_query->delete();

        return back()->with('message', 'Query deleted successfully');
    }
}
