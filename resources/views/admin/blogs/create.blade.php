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
                    <h5 class="m-0">Add Blog</h5>
                    <div class="btn-group ml-auto">
                        <a href="{{route('admin.blogs.index')}}" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;List</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.blogs.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Select Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option selected value="" >Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Title</label>
                                <input type="text" name="title" class="form-control" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control" required />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image</label>
                                <input type="file" id="image" name="image" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image Alt</label>
                                <input type="text" id="image_alt" name="image_alt" class="form-control"  />
                            </div>
                            
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Highlighte Keywords</label>
                                <input type="text" id="highlight_keywords" name="highlight_keywords" class="form-control"  />
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected value="1" >Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        <div class="col-6 file-div mb-3">
                            <label for="basic-url">Descriprion <small>(For listing page)</small></label>
                            <textarea rows="4" cols=""  id="listing_page_description" name="listing_page_description" class="form-control">{{old('listing_page_description')}}</textarea> 
                        </div>
                        <hr>
                            <h3>Meta</h3>
                        <div class="row">
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Title</label>
                                <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control"  />
                            </div>
                            
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Keywords</label>
                                <input type="text" id="meta_tag_keyword" name="meta_tag_keyword" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Descriprion</label>
                                <textarea rows="4" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control"></textarea> 
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