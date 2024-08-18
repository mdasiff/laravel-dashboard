@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banner</h1>
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
                <a href="{{ route('admin.banner.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="form-group col-6">
                          <label for="image">Banner Image <small>(Recommand Size - 1900x800)</small><span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*">
                          @if(!empty($banner->image))
                          <img class="mt-1" src="{{$banner->image}}" width="100px">
                          @endif
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image_mobile">Mobile Banner Image<span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="image_mobile" name="image_mobile" accept="image/*">
                          @if(!empty($banner->image_mobile))
                          <img class="mt-1" src="{{$banner->image_mobile}}" width="100px">
                          @endif
                          @error('image_mobile')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="name">Title <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="title" placeholder="Enter Banner title" value="{{old('title',$banner->title)}}">
                          @error('title')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="image_alt">Image ALT</label>
                          <input type="text" class="form-control" id="image_alt" name="image_alt" placeholder="Enter image alt" value="{{old('image_alt',$banner->image_alt)}}">
                          @error('image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="name">Sub Title <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="name" name="subtitle" placeholder="Enter Banner subtitle" value="{{old('image_alt',$banner->subtitle)}}">
                          @error('subtitle')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="cta_text">CTA Text</label>
                          <input type="text" class="form-control" id="cta_text" name="cta_text" placeholder="Enter CTA Text" value="{{old('cta_text',$banner->cta_text)}}">
                          @error('cta_text')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="email">CTA Link</label>
                          <input type="text" class="form-control" id="link" name="link" placeholder="Enter CTA Link" value="{{old('link',$banner->link)}}">
                          @error('link')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="sort">Sort Order</label>
                          <input type="number" class="form-control" id="sort" name="sort" placeholder="Enter Sort Order" value="{{old('sort',$banner->sort)}}">
                          @error('sort')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="price_inr">Status</label>
                          <select class="form-control" name="status">
                            <option {{($banner->status == 1)?'selected':''}} value="1">Active</option>
                            <option {{($banner->status == 0)?'selected':''}} value="0">Inactive</option>
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