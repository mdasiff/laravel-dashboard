@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Webinars</h1>
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
                <h5 class="">List ({{$webinars->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.webinar.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
                </div>
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
                      <th>Title</th>
                      <th>Webinar Date</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($webinars as $key => $webinar)
                    <tr>
                      <td>{{  $key + 1 }}</td>
                      <td>{{ $webinar->title }}</td>
                      <td>{{ date('D, d M, Y', strtotime($webinar->webinar_date))}} ({{date('H:m a', strtotime($webinar->webinar_date))}})</td>
                      <td>{{ $webinar->created_at->format('d-M, Y') }}</td>
                      <td>
                          <a href="{{ route('admin.webinar.edit', $webinar) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                      </td>
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