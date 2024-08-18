@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Service Category</h1>
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
                <a href="{{ route('admin.industry-category.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.industry.update', $ic->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="form-group col-6">
                          <label for="name">Category <span class="text-danger">*</span></label>
                          
                          <select class="form-control" name="category" id="category" required>
                            <option value="">Select</option>
                            @foreach($categories as $category)
                            <option {{old('category',$ic->industry_category_id)==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>

                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">Image</label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                          @if(!empty($ic->image))
                          <img class="mt-1" src="{{$ic->image}}" width="100px">
                          @endif
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">Image Alt </label>
                          <input type="text" class="form-control" name="image_alt" value ="{{$ic->image_alt}}" />
                          @error('image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">PDF<span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="file" name="file" accept="application/pdf" />
                          @error('file')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="name">Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="name" required placeholder="Enter name" value="{{old('name',$ic->name)}}" />
                          @error('name')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="slug">Slug <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="slug" name="slug" required placeholder="Enter slug" value="{{old('slug',$ic->slug)}}" />
                          @error('slug')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="description">Description</label>
                          <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="{{old('description',$ic->description)}}" />
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="sort">Sort Order <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="sort" name="sort" required placeholder="Enter sort" value="{{old('sort',$ic->sort)}}" />
                          @error('sort')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="price_inr">Status</label>
                          <select class="form-control" name="status">
                            <option {{($ic->status == 1)?'selected':''}} value="1">Active</option>
                            <option {{($ic->status == 0)?'selected':''}} value="0">Inactive</option>
                          </select>
                      </div>

                      <div class="col-md-12">
                        <hr/>
                        <h4>Metas</h4>
                        <hr/>
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{old('meta_tag_title',$ic->meta_tag_title)}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control" value="{{old('meta_tag_keywords',$ic->meta_tag_keywords)}}"  />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Descriprion</label>
                          <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control">{{old('meta_tag_description',$ic->meta_tag_description)}}</textarea> 
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