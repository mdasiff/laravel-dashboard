@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blogs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blogs</li>
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
                    <h5 class="">List ({{$blogs->count()}})</h5>
                    <div class="btn-group ml-auto">
                      <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Title</td>
                                <td>Subtitle</td>
                                <td>Image</td>
                                <td>Status</td>
                                <td>Views</td>
                                <td>Posts</td>
                                <td>Action</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($blogs as $row => $blog)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->sub_title}}</td>
                                    <td>
                                    @if($blog->image)
                                <div class="image-div w-full text-center">
                                    <img width="100" alt="" src="{{$blog->image}}" />
                                </div>
                                @endif
                                    </td>
                                    <td>
                                        @if($blog->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>{{$blog->views}}</td>
                                    <td>
                                    <a href="{{route('admin.blogpost.index', $blog->id)}}" class="btn btn-primary d-flex"><span>Posts </span> <span> ({{$blog->posts->count()}})</span></a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('blogDetail', $blog->slug)}}" class="btn btn-success" target="_blank">View</a>
                                            @if($blog->status)
                                            <a href="{{route('admin.blogs.status_update', $blog->id)}}" class="btn btn-primary">Disabled</a>
                                            @else
                                            <a href="{{route('admin.blogs.status_update', $blog->id)}}"  class="btn btn-secondary">Enabled</a>
                                            @endif
                                            <a href="{{route('admin.blogs.edit', $blog->id)}}" class="btn btn-warning" type="button">Edit</a>
                                            <a href="{{route('admin.blogs.delete', $blog->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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