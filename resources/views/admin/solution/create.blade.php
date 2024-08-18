@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Solution</h1>
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
                <a href="{{ route('admin.solution.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.solution.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="form-group col-6">
                          <label for="name">Category <span class="text-danger">*</span></label>
                          <select class="form-control" name="category" id="category" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                            <option {{old('category')==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>

                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">Image<span class="text-danger">*</span> <small class="mutted">(Recommand Size - 1200x400)</small></label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image">Image Alt</label>
                          <input type="text" class="form-control" name="image_alt" value ="{{old('image_alt')}}" />
                          @error('image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image">PDF<span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="file" name="file" accept="application/pdf" >
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="name">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="name" required placeholder="Enter name" value="{{old('name')}}">
                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      
                      <div class="form-group col-6">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{old('description')}}">
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="sort">Sort Order <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="sort" name="sort" required placeholder="Enter sort" value="{{old('sort')}}">
                          @error('sort')
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
                      <div class="col-md-12">
                        <hr/>
                        <h4>Metas</h4>
                        <hr/>
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{old('meta_tag_title')}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control" value="{{old('meta_tag_keywords')}}"  />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Descriprion</label>
                          <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control">{{old('meta_tag_description')}}</textarea> 
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