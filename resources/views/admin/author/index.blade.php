@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Author</h1>
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
                <h5 class="">List ({{$authors->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.author.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
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
                        <th>Image</th>
                        <th>Designation</th>
                        <th>Description</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $key => $data)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                          {{$data->name}}
                        </td>
                        <td>
                          @if($data->image)
                          <div class="mb-3 image-wrapper"><img src="{{ $data->image }}"></div>
                          @endif
                        </td>
                        <td>
                          {{$data->designation}}
                        </td>
                        <td>
                          {!!$data->description!!}
                        </td>
                        
                        <td>
                          {{$data->sort}}
                        </td>
                        <td>
                          @if($data->status)
                          <span class="badge badge-success">Enabled</span>
                          @else
                          <span class="badge badge-danger">Disabled</span>
                          @endif
                        </td>
                        <td>{{ $data->created_at->format('d-M, Y') }}</td>
                        <td>
                          <div class="btn-group">
                           
                            @if($data->status)
                            <a href="{{ route('admin.author.status_update', $data->id) }}" class="btn btn-sm btn-secondary">Disable</a>
                            @else
                            <a href="{{ route('admin.author.status_update', $data->id) }}" class="btn btn-sm btn-default">Enable</a>
                            @endif
                            <a href="{{ route('admin.author.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a onClick="return confirm('Are you sure?')" href="{{ route('admin.author.delete', $data->id) }}" class="btn btn-sm btn-danger">Delete</a>
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