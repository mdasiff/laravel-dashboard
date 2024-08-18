@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Positions</h1>
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
                <h5 class="">List ({{$positions->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.positions.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
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
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Openings</th>
                        <th>Experience</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($positions as $key => $position)
                      <tr>
                        <td>{{  $key + 1 }}</td>
                        <td>{{ $position->title }}</td>
                        <td>{{ $position->location }}</td>
                        <td>{{ $position->duration }}</td>
                        <td>{{ $position->vacancy }}</td>
                        <td>{{ $position->experience }}</td>
                        <td>{{ $position->sort }}</td>
                        <td>
                            @if($position->status)
                            <span class="badge badge-success">Enabled</span>
                            @else
                            <span class="badge badge-danger">Disabled</span>
                            @endif
                        </td>
                        <td>{{ $position->created_at->format('d-M, Y') }}</td>
                        <td>
                            <div class="btn-group">
                                @if($position->status)
                                <a href="{{route('admin.positions.status_update', $position->id)}}" class="btn btn-primary">Disabled</a>
                                @else
                                <a href="{{route('admin.positions.status_update', $position->id)}}"  class="btn btn-secondary">Enabled</a>
                                @endif
                                <a href="{{route('admin.positions.edit', $position->id)}}" class="btn btn-warning" type="button">Edit</a>
                                <a href="{{route('admin.positions.delete', $position->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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