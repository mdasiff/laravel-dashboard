@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Posts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog Posts</li>
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
                
                <div class="card-header d-flex justify-content-between" style="display:ruby">
                    <h5 class="m-0">Posts List</h5>
                    <div class="btn-group ml-auto">
                        <a href="{{route('admin.blogpost.create', $blog->id)}}" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;Add</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Heading</td>
                                <td>Post</td>
                                <td>Image</td>
                                <td>Status</td>
                                <td>Sort</td>
                                <td>Action</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($posts as $row => $post)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$post->heading}}</td>
                                    <td>{!!$post->post!!}</td>
                                    <td>
                                        @if($post->image) 
                                        <div class="mb-3 image-wrapper text-center w-100"><img width="100" src="{{ $post->image }}"></div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($post->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>{{$post->sort}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($post->status)
                                            <a href="{{route('admin.blogpost.status_update', $post->id)}}" class="btn btn-primary">Disabled</a>
                                            @else
                                            <a href="{{route('admin.blogpost.status_update', $post->id)}}"  class="btn btn-secondary">Enabled</a>
                                            @endif
                                            <a href="{{route('admin.blogpost.edit', [$blog->id, $post->id])}}" class="btn btn-warning" type="button">Edit</a>
                                            <a href="{{route('admin.blogpost.delete', $post->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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