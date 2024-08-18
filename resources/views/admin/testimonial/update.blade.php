@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Testimonials <h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Testimonials</li>
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
                <div class="card-header d-flex justify-content-between">
                <h5>Edit</h5>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.testimonials.update', $testimonial->id)}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Name</label>
                                <input type="text" name="name" class="form-control"  value="{{$testimonial->name}}"  />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Location</label>
                                <input type="text" name="location" class="form-control" value="{{$testimonial->location}}" required />
                            </div>
                            <div class="col-6 link-div mb-3">
                                <label for="basic-url">Message</label>
                                <textarea rows="5" class="form-control" name="message" required>{{$testimonial->message}}</textarea>
                            </div>
                            <div class="col-6 video-div mb-3">
                                <label for="basic-url">Video <small>YouTube Embed Link</small>&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" id="video" name="video" class="form-control" value="{{$testimonial->video}}" />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image</label>
                                <input type="file" id="image" name="image" class="form-control"  />
                                @if($testimonial->image)
                                <div class="image-div w-full text-center">
                                    <img width="150px" alt="" src="{{$testimonial->image}}" />
                                </div>
                                @endif
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image Alt</label>
                                <input type="text" id="image_alt" name="image_alt" class="form-control"  value="{{$testimonial->image_alt}}" />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{($testimonial->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($testimonial->status == 0) ? 'selected' : ''}}>Disabled</option>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="show_on_home_page">Show on home page</label>
                                <select class="form-control" id="show_on_home_page" name="show_on_home_page">
                                    <option {{($testimonial->show_on_home_page == 1) ? 'selected' : ''}} value="1" >Yes</option>
                                    <option {{($testimonial->show_on_home_page == 0) ? 'selected' : ''}} value="0">No</option>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="basic-url">Sort</label>
                                <input type="number" name="sort" value="{{$testimonial->sort}}" class="form-control" required />
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
