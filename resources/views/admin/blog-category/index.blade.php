@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog Category</li>
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
                    <h5 class="">List ({{$categories->count()}})</h5>
                    <div class="btn-group ml-auto">
                      <a href="{{ route('admin.blog-category.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Name</td>
                                <td>Status</td>
                                <td>Sort</td>
                                <td>Action</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($categories as $row => $category)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>
                                        @if($category->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>{{$category->sort}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($category->status)
                                            <a href="{{route('admin.blog-category.status_update', $category->id)}}" class="btn btn-primary">Disabled</a>
                                            @else
                                            <a href="{{route('admin.blog-category.status_update', $category->id)}}"  class="btn btn-secondary">Enabled</a>
                                            @endif
                                            <a href="{{route('admin.blog-category.edit', $category->id)}}" class="btn btn-warning" type="button">Edit</a>
                                            <a href="{{route('admin.blog-category.delete', $category->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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