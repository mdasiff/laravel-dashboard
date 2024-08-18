@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Life@Merino</h1>
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
                <a href="{{ route('admin.life_merino.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.life_merino.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                      <div class="form-group col-6">
                          <label for="image">Image</label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image">Image Alt </label>
                          <input type="text" class="form-control" name="image_alt" value ="{{old('image_alt')}}" required />
                          @error('image_alt')
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