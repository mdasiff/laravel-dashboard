@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Candidates</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5 class="">List ({{$candidates->count()}})</h5>
              </div>
              <div class="card-body">
               @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('updated'))
               <div class="alert alert-success">{{Session::get('updated')}}</div>
               @endif
               <!--start table-->
               <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Sr. No</th>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Experience</th>
                        <th>DOB</th>
                        <th>Location</th>
                        <th>Applied At</th>
                        <th>Resume</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($candidates as $key => $candidate)
                      <tr>
                        <td>{{  $key + 1 }}</td>
                        <td>{{ $candidate->position->title??'' }}</td>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ $candidate->phone }}</td>
                        <td>{{ $candidate->total_experience }}</td>
                        <td>{{ $candidate->dob }}</td>
                        <td>{{ $candidate->location }}</td>
                        <td>{{ $candidate->created_at->format('d-M, Y') }}</td>
                        <td>{{ $candidate->resume }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
               <!--end table-->
            
              </div>
            </div>
          </div>
          <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  @endsection