@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">News</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif

        <div class="row">
          
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5>Update</h5>
                <a href="{{ route('admin.news.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.news.update',$news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="form-group col-6">
                          <label for="thumbnail_image">Thumbnail Image<span class="text-danger">*</span> <small class="mutted">(Recommand Size - 1200x400)</small></label>
                          <input type="file" class="form-control" id="thumbnail_image" name="image_mobile" accept="mage/*">
                          @error('thumbnail_image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          @if($news->thumbnail)
                          <img src="{{$news->thumbnail}}" style="max-height: 75px; max-width: 75px;" class="mt-2">
                          @endif
                      </div>

                      <div class="form-group col-6">
                          <label for="thumbnail_alt">Thumbnail Alt</label>
                          <input type="text" class="form-control" name="thumbnail_alt" value ="{{old('thumbnail_alt',$news->thumbnail_alt)}}" />
                          @error('thumbnail_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="image">Image<small class="mutted">(Recommand Size - 1200x400)</small></label>
                          <input type="file" class="form-control" id="image" name="image" accept="image/*">
                          @error('image')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                          @if($news->image)
                          <img src="{{$news->image}}" style="max-height: 75px; max-width: 75px;" class="mt-2">
                          @endif
                      </div>
                      <div class="form-group col-6">
                          <label for="image">Image Alt</label>
                          <input type="text" class="form-control" name="image_alt" value ="{{old('image_alt',$news->image_alt)}}" />
                          @error('image_alt')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="title">Title <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="title" name="title" required placeholder="Enter title" value="{{old('title',$news->title)}}">
                          @error('title')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="slug">Slug <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="slug" name="slug" required placeholder="Enter slug" value="{{old('slug',$news->slug)}}">
                          @error('slug')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group col-6">
                          <label for="tag">Tag</label>
                          <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter tag" value="{{old('tag',$news->tag)}}">
                          @error('tag')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      
                      <div class="form-group col-6">
                          <label for="short_description">Short Description</label>
                          <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder="Enter short_description">{{old('short_description',$news->short_description)}}</textarea>
                          @error('short_description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      


                      <div class="form-group col-6">
                          <label for="sort">Sort Order <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="sort" name="sort" required placeholder="Enter sort" value="{{old('sort',$news->sort)}}">
                          @error('sort')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group col-6">
                          <label for="status">Status</label>
                          <select class="form-control" name="status">
                            <option {{old('status',$news->status)==1?'selected':''}} value="1">Active</option>
                            <option {{old('status',$news->status)==0?'selected':''}} value="0">Inactive</option>
                          </select>
                      </div>

                      <div class="form-group col-12">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description">{!!old('description',$news->description)!!}</textarea>
                          @error('description')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="col-md-12">
                        <hr/>
                        <h4>Metas</h4>
                        <hr/>
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{old('meta_tag_title',$news->meta_tag_title)}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control" value="{{old('meta_tag_keywords',$news->meta_tag_keywords)}}"  />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Descriprion</label>
                          <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control">{{old('meta_tag_description',$news->meta_tag_description)}}</textarea> 
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