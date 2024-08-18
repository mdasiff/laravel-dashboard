<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function candidates() {
        $candidates = Candidate::orderBy('id', 'DESC')->get();
        return view('admin.position.candidates',compact('candidates'));
    }
}
