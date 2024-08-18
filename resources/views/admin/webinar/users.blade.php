@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Webinar Users</h1>
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
                <h5 class="">List ({{$users->count()}})</h5>
                <!-- <div class="btn-group ml-auto">
                  <a href="{{ route('admin.webinar.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
                </div> -->
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
                      <th>Webinar</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Job Title</th>
                      <th>Company</th>
                      <th>Country</th>
                      <th>Registered At</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $key => $user)
                    <tr>
                      <td>{{  $key + 1 }}</td>
                      <td>{{ $user->webinar->title }}</td>
                      <td>{{ $user->fname }}</td>
                      <td>{{ $user->lname }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>{{ $user->job_title }}</td>
                      <td>{{ $user->company }}</td>
                      <td>{{ $user->country }}</td>
                      <td>{{ $user->created_at->format('d-M, Y') }}</td>
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