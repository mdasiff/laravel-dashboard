@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Testimonials</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Testimonials</li>
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
                <div class="card-header d-flex justify-content-between">
                <h5>Create</h5>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary ml-auto">Create <i class="fas fa-plus"></i></a>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Name</td>
                                <td>Location</td>
                                <td>Message</td>
                                <td>Video</td>
                                <td>Image</td>
                                <td>On Home</td>
                                <td>Status</td>
                                <td>Sort</td>
                                <td>Action</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($testimonials as $row => $testimonial)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$testimonial->name}}</td>
                                    <td>{{$testimonial->location}}</td>
                                    <td>{{$testimonial->message}}</td>
                                    <td>
                                        @if($testimonial->video)
                                        <a target="_blank" href="{{$testimonial->video}}">Play</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($testimonial->image)
                                            <img src="{{$testimonial->image}}" width="100" />
                                        @endif
                                    </td>
                                    <td>
                                        @if($testimonial->show_on_home_page)
                                        <span class="badge badge-success">Yes</span>
                                        @else
                                        <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($testimonial->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>{{$testimonial->sort}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($testimonial->status)
                                            <a href="{{route('admin.testimonials.status_update', $testimonial->id)}}" class="btn btn-primary">Disabled</a>
                                            @else
                                            <a href="{{route('admin.testimonials.status_update', $testimonial->id)}}"  class="btn btn-secondary">Enabled</a>
                                            @endif
                                            <a href="{{route('admin.testimonials.edit', $testimonial->id)}}" class="btn btn-warning" type="button">Edit</a>
                                            <a href="{{route('admin.testimonials.delete', $testimonial->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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