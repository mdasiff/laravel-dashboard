@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Author</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text-danger">:message</div>')) !!}
        @endif

        <div class="row">
          
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5>Update</h5>
                <a href="{{ route('admin.author.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.author.update',$author->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="form-group col-6">
                          <label for="image">Image<small class="mutted">(Recommand Size - 1200x400)</small></label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*">
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          @if($author->image)
                          <img src="{{$author->image}}" style="max-height: 75px; max-width: 75px;" class="mt-2">
                          @endif
                      </div>


                      <div class="form-group col-6">
                          <label for="name">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="name" required placeholder="Enter name" value="{{old('name',$author->name)}}">
                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="designation">Designation <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="designation" name="designation" required placeholder="Enter designation" value="{{old('designation',$author->designation)}}">
                          @error('designation')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="sort">Sort Order <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="sort" name="sort" required placeholder="Enter sort" value="{{old('sort',$author->sort)}}">
                          @error('sort')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="status">Status</label>
                          <select class="form-control" name="status">
                            <option {{old('status',$author->status)==1?'selected':''}} value="1">Active</option>
                            <option {{old('status',$author->status)==0?'selected':''}} value="0">Inactive</option>
                          </select>
                      </div>

                      <div class="form-group col-12">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description">{!!old('description',$author->description)!!}</textarea>
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
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
  @push('js')
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    // Initialize CKEditor on the textarea
    CKEDITOR.replace('description');
  </script>
  @endpush
  @endsection