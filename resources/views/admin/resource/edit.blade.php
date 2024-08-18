@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Resource</h1>
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
                <a href="{{ route('admin.resource.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.resource.update', $rc->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="form-group col-6">
                          <label for="name">Category <span class="text-danger">*</span></label>
                          
                          <select class="form-control" name="category" id="category" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                            <option {{old('category',$rc->resource_category_id)==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>

                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="name">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="name" required placeholder="Enter name" value="{{old('name',$rc->name)}}">
                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">Image<span class="text-danger">*</span> <small class="mutted">(Recommand Size - 1200x400)</small></label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*">
                          @if(!empty($rc->image))
                          <img class="mt-1" src="{{$rc->image}}" width="100px">
                          @endif
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image">Image Alt</label>
                          <input type="text" class="form-control" name="image_alt" value ="{{$rc->image_alt}}" />
                          @error('image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="col-6 mb-3">
                        <label for="show_on_home_page">Show on home page</label>
                        <select class="form-control" id="show_on_home_page" name="show_on_home_page">
                            <option {{($rc->show_on_home_page == 1) ? 'selected' : ''}} value="1" >Yes</option>
                            <option {{($rc->show_on_home_page == 0) ? 'selected' : ''}} value="0">No</option>
                        </select>
                      </div>

                      <div class="form-group col-6">
                          <label for="image_mobile">Home Image</label>
                          <input type="file" class="form-control" id="image_mobile" name="image_mobile" accept="image/*">
                          @if(!empty($rc->home_image))
                          <img class="mt-1" src="{{$rc->home_image}}" width="100px">
                          @endif
                          @error('image_mobile')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="home_image_alt">Home Image Alt</label>
                          <input type="text" class="form-control" name="home_image_alt" value ="{{old('home_image_alt',$rc->home_image_alt)}}" />
                          @error('home_image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">PDF<span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          @if(!empty($rc->file))
                          <a class="mt-1" href="{{$rc->file}}" target="_blank"><small>{{$rc->raw_file}}</small></a>
                          @endif
                      </div>
                      
                      <div class="form-group col-6">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{old('description',$rc->description)}}">
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="sort">Sort Order <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="sort" name="sort" required placeholder="Enter sort" value="{{old('sort',$rc->sort)}}">
                          @error('sort')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="price_inr">Status</label>
                          <select class="form-control" name="status">
                            <option {{($rc->status == 1)?'selected':''}} value="1">Active</option>
                            <option {{($rc->status == 0)?'selected':''}} value="0">Inactive</option>
                          </select>
                      </div>
                      <div class="col-md-12">
                        <hr/>
                        <h4>Metas</h4>
                        <hr/>
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Meta Tag Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{old('meta_tag_title',$rc->meta_tag_title)}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Meta Tag Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control"  value="{{old('meta_tag_keywords',$rc->meta_tag_keywords)}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Meta Tag Descriprion</label>
                          <textarea rows="2" id="meta_tag_description" name="meta_tag_description" class="form-control"> {{old('meta_tag_description',$rc->meta_tag_description)}}</textarea> 
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