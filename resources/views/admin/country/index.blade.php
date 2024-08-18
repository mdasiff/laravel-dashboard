@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Countries</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Countries</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12">
          @component('components.alert')
          @endcomponent
            <div class="card">
                <div class="card-header" style="display:ruby">
                    <h5 class="m-0">Country List - ({{$countries->count()}})</h5>
                    <a href="{{route('admin.country.create')}}" class="btn btn-primary" style="float:right"><i class="fa fa-plus"></i>&nbsp;Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Name</td>
                                <td>Image</td>
                                {{-- <td>Status</td> --}}
                                <td>Actions</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($countries as $row => $country)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$country->name}}</td>
                                    <td>
                                        @if($country->image) 
                                        <div class="mb-3 image-wrapper text-center w-100"><img width="100px" src="{{ $country->image }}"></div>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @if($country->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                        <div class="btn-group">
                                          {{-- @if($country->status)
                                          <a href="{{route('admin.country.status_update', $country->id)}}" class="btn btn-primary">Disabled</a>
                                          @else
                                          <a href="{{route('admin.country.status_update', $country->id)}}"  class="btn btn-secondary">Enabled</a>
                                          @endif --}}
                                          <a href="{{route('admin.country.edit', $country->id)}}" class="btn btn-warning" type="button">Edit</a>
                                          <a href="{{route('admin.country.delete', $country->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
               
                </div>
            </div>
          </section>
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection