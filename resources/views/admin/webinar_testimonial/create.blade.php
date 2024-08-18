@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Webinar Testimonials <h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Webinar Testimonials</li>
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
                <h5>Create</h5>
                <a href="{{ route('admin.webinar_testimoni.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.webinar_testimoni.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Name</label>
                                <input type="text" name="name" class="form-control"  value="{{old('name')}}"  />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Type</label>
                                <select name="type" id="type" class="form-control" required >
                                  <option selected value="text">Text</option>
                                  <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Location</label>
                                <input type="text" name="location" class="form-control" value="{{old('location')}}" required />
                            </div>
                            <div class="col-6 link-div mb-3">
                                <label for="basic-url">Message</label>
                                <textarea rows="5" class="form-control" name="message" required>{{old('message')}}</textarea>
                            </div>
                            <div class="col-6 d-none video-div mb-3">
                                <label for="basic-url">Video <small>YouTube Embed Link</small>&nbsp;<span class="text-danger">*</span></label>
                                <input type="text" id="video" name="video" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image</label>
                                <input type="file" id="image" name="image" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Image Alt</label>
                                <input type="text" id="image_alt" name="image_alt" class="form-control"  />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected value="1" >Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                            
                     
                            <div class="col-6 mb-3">
                                <label for="sort">Sort</label>
                                <input type="number" name="sort" value="{{(old('sort')) ? old('sort') : 0}}" class="form-control" required />
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

@push('js')
<script>
  $(function() {
    $('#type').on('change', function() {
      if($('#type').val() == 'text') {
        $('.file-div').removeClass('d-none');
        $('.video-div').addClass('d-none');
      } else if($('#type').val() == 'video') {
        $('.file-div').addClass('d-none');
        $('.video-div').removeClass('d-none');
      }
    });
  });
</script>
@endpush
