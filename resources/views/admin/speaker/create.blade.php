@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Speaker</h1>
          </div><!-- /.col -->
          
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
                <h5>Create</h5>
                <a href="{{ route('admin.speaker.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
        <form action="{{ route('admin.speaker.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group ">
                <label for="image">Image Alt</label>
                <input type="text" class="form-control" name="image_alt" value ="{{old('image_alt')}}" />
                @error('image_alt')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter speaker name" value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{old('email')}}">
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price_inr">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" value="{{old('designation')}}">
                @error('designation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror 
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
               
               <!--end form-->
               <!-- <p class="card-text">loremt lorem</p> -->
               <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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