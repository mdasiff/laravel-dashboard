@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Position</h1>
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
                <a href="{{ route('admin.positions.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.positions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-6">
                          <label for="name">Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title..." value="{{old('title')}}" required>
                          @error('title')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="name">Location</label>
                          <input type="text" class="form-control" id="location" name="location" placeholder="Enter location..." value="{{old('location')}}" required>
                          @error('location')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="name">Duration</label>
                          <input type="text" class="form-control" id="duration" name="duration"  value="" required>
                          @error('duration')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="vacancy">Open Positions</label>
                          <input type="number" class="form-control" id="vacancy" name="vacancy"  value="" required>
                          @error('vacancy')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="experience">Experience</label>
                          <input type="text" class="form-control" id="vacancy" name="experience"  value="">
                          @error('experience')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">Status</label>
                          <select class="form-control" id="status" name="status">
                              <option selected value="1" >Enabled</option>
                              <option value="0">Disabled</option>
                          </select>
                          @error('status')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">Sort</label>
                          <input type="number" name="sort" value="0" class="form-control"  />
                      </div>

                      <div class="col-12 link-div mb-3">
                          <label for="basic-url">Description</label>
                          <textarea rows="5" class="form-control" name="description" required></textarea>
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      
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
  @push('js')
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    // Initialize CKEditor on the textarea
    CKEDITOR.replace('description');
  </script>
  @endpush
  @endsection