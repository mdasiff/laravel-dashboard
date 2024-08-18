@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Industry Category</h1>
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
                <h5 class="">List ({{$industry_categories->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.industry-category.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($industry_categories as $key => $ic)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                          {{$ic->name}}
                        </td>
                        <td>
                          {{$ic->description}}
                        </td>
                        <td>
                          <div class="mb-3 image-wrapper"><img src="{{ $ic->image }}"></div>
                        </td>
                        <td>
                          @if($ic->status)
                          <span class="badge badge-success">Enabled</span>
                          @else
                          <span class="badge badge-danger">Disabled</span>
                          @endif
                        </td>
                        <td>{{ $ic->created_at->format('d-M, Y') }}</td>
                        <td>
                          <div class="btn-group">
                            @if($ic->status)
                            <a href="{{ route('admin.industry-category.status_update', $ic->id) }}" class="btn btn-sm btn-secondary">Disable</a>
                            @else
                            <a href="{{ route('admin.industry-category.status_update', $ic->id) }}" class="btn btn-sm btn-default">Enable</a>
                            @endif
                            <a href="{{ route('admin.industry-category.edit', $ic->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <a onClick="return confirm('Are you sure?')" href="{{ route('admin.industry-category.delete', $ic->id) }}" class="btn btn-sm btn-danger">Delete</a>
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