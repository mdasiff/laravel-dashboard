@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Post</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog Post</li>
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
                    <h5 class="m-0">Add Blog Post</h5>
                    <div class="btn-group ml-auto">
                        <a href="{{route('admin.blogpost.create', $blog->id)}}" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;Posts List</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.blogpost.update',[$blog->id, $post->id])}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{$post->heading}}"  />
                            </div>
                            
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image</label>
                                <input type="file" id="image" name="image" class="form-control"  />
                                @if($post->image)
                                <div class="image-div w-full text-center">
                                    <img width="80" alt="" src="{{ $post->image }}" />
                                </div>
                                @endif
                            </div>

                            <div class="col-6 mb-3">
                                <label for="basic-url">Image Alt</label>
                                <input type="text" name="image_alt" class="form-control" value="{{$post->image_alt}}" />
                            </div>

                            <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{($post->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($post->status == 0) ? 'selected' : ''}}>Disabled</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Sort</label>
                                <input type="number" name="sort" class="form-control" value="{{$post->sort}}" required />
                            </div>

                            <div class="col-12 link-div mb-3">
                                <label for="basic-url">Post</label>
                                <textarea rows="5" class="form-control" name="post" required>{!!old('post',$post->post)!!}</textarea>
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
  @push('js')
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    // Initialize CKEditor on the textarea
    CKEDITOR.replace('post');
</script>
  @endpush
@endsection
