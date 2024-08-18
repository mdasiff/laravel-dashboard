@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employee Speak</h1>
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
                <h5 class="">List ({{$employee_speaks->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.employee-speak.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
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
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Image</th>
                        <th>description</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($employee_speaks as $key => $lm)
                      <tr>
                        <td>{{  $key + 1 }}</td>
                        <td>{{ $lm->name }}</td>
                        <td>{{ $lm->designation }}</td>
                        <td><img src="{{ $lm->image }}" width="100" /></td>
                        <td>{!! $lm->description !!}</td>
                        <td>{{ $lm->sort }}</td>
                        <td>
                          @if($lm->status)
                          <span class="badge badge-success">Enabled</span>
                          @else
                          <span class="badge badge-danger">Disabled</span>
                          @endif
                        </td>
                        <td>{{ $lm->created_at->format('d-M, Y') }}</td>
                        <td>
                            <div class="btn-group">
                                @if($lm->status)
                                <a href="{{route('admin.employee-speak.status_update', $lm->id)}}" class="btn btn-primary">Disabled</a>
                                @else
                                <a href="{{route('admin.employee-speak.status_update', $lm->id)}}"  class="btn btn-secondary">Enabled</a>
                                @endif
                                <a href="{{route('admin.employee-speak.edit', $lm->id)}}" class="btn btn-warning" type="button">Edit</a>
                                <a href="{{route('admin.employee-speak.delete', $lm->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
                            </div>
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