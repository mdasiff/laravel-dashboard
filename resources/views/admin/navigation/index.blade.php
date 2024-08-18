@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Navigation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Navigation</li>
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
                    <h5 class="">List ({{$navigations->count()}})</h5>
                    <div class="btn-group ml-auto">
                      <a href="{{ route('admin.navigation.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>S.N.</td>
                                <td>Parent Tree</td>
                                <td>Item Name</td>
                                <td>Type</td>
                                <td>Status</td>
                                <td>Level</td>
                                <td>Sort</td>
                                <td>Action</td>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach($navigations as $row => $navigation)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>
                                        @if($navigation->main_menu_id)    
                                                {{($navigation->main_menu) ? $navigation->main_menu->name : ''}} > {{($navigation->parent) ? $navigation->parent->name : ''}}
                                        @else
                                            {{($navigation->parent) ? $navigation->parent->name : ''}}
                                        @endif
                                    </td>
                                    <td>{{$navigation->name}}</td>
                                    <td>
                                        @if($navigation->type == 'link')
                                            {{$navigation->link}}
                                        @else
                                            <a href="{{url('uploads/navigation/'.$navigation->file)}}" target="_blank"><i class="fa fa-2x fa-file-pdf"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($navigation->status)
                                        <span class="badge badge-success">Enabled</span>
                                        @else
                                        <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($navigation->level == 0)
                                            Main Menu Item
                                        @elseif($navigation->level == 1)
                                            Level 1 Menu Item
                                        @else 
                                            Level 2 Menu Item
                                        @endif
                                    </td>
                                    <td>{{$navigation->sort}}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($navigation->status)
                                            <a href="{{route('admin.navigation.status_update', $navigation->id)}}" class="btn btn-primary">Disabled</a>
                                            @else
                                            <a href="{{route('admin.navigation.status_update', $navigation->id)}}"  class="btn btn-secondary">Enabled</a>
                                            @endif
                                            <a href="{{route('admin.navigation.edit', $navigation->id)}}" class="btn btn-warning" type="button">Edit</a>
                                            <a href="{{route('admin.navigation.delete', $navigation->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn btn-danger">Delete</a>
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