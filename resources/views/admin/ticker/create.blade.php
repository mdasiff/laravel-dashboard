@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ticker</h1>
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
                <a href="{{ route('admin.ticker.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.ticker.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      
                      <div class="form-group col-6">
                          <label for="name">Counter <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="counter" required placeholder="Enter ticker counter" value="{{old('counter')}}">
                          @error('counter')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="name">Tag <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter ticker tag" value="{{old('tag')}}">
                          @error('tag')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="email">Description <span class="text-danger">*</span></label>
                          <input type="text" required class="form-control" id="description" name="description" placeholder="Enter description" value="{{old('description')}}">
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="price_inr">Status</label>
                          <select class="form-control" name="status">
                            <option selected value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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