@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12">
          @component('components.alert')
            @endcomponent
            <div class="card">
                <div class="card-header d-flex justify-content-between" style="display:ruby">
                    <h5 class="m-0">Edit Blog</h5>
                    <div class="btn-group ml-auto">
                        <a href="{{route('admin.blogs.index')}}" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;List</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.blogs.update', $blog->id)}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Select Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option selected value="" >Select Category</option>
                                    @foreach($categories as $category)
                                    <option {{($blog->blog_category_id == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Title</label>
                                <input type="text" name="title" class="form-control" value="{{$blog->title}}" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control" value="{{$blog->sub_title}}" required />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image</label>
                                <input type="file" id="image" name="image" class="form-control"  />
                                @if($blog->image)
                                <div class="image-div w-full text-center">
                                    <img width="150px" alt="" src="{{asset('uploads/blogs/'.$blog->image)}}" />
                                </div>
                                @endif
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image Alt</label>
                                <input type="text" id="image_alt" name="image_alt" class="form-control" value="{{$blog->image_alt}}" />
                            </div>

                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Highlighte Keywords</label>
                                <input type="text" id="highlight_keywords" name="highlight_keywords" value="{{$blog->highlight_keywords}}" class="form-control"  />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{($blog->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($blog->status == 0) ? 'selected' : ''}}>Disabled</option>
                                </select>
                            </div>

                            <div class="col-6 file-div mb-3">
                            <label for="basic-url">Descriprion <small>(For listing page)</small></label>
                            <textarea rows="4" cols=""  id="listing_page_description" name="listing_page_description" class="form-control">{{old('listing_page_description', $blog->listing_page_description)}}</textarea> 
                        </div>

                            </div>
                            <hr>
                            <h3>Meta</h3>
                        <div class="row">
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Title</label>
                                <input type="text" id="meta_tag_title" name="meta_tag_title" value="{{$blog->meta_tag_title}}" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Keywords</label>
                                <input type="text" id="meta_tag_keyword" name="meta_tag_keyword" class="form-control"  value="{{$blog->meta_tag_keyword}}" />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Descriprion</label>
                                <textarea rows="4" cols=""  id="meta_tag_description" name="meta_tag_description"  class="form-control">{{$blog->meta_tag_description}}</textarea> 
                            </div>
                            
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </section>
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection