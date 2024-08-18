@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Webinar</h1>
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
                <a href="{{ route('admin.webinar.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.webinar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                      <div class="col-6 mb-3">
                          <label for="basic-url">Speakers</label>
                          <select class="form-control select2" name="speaker">
                            <option value="">Select Speakers</option>
                            @foreach($speakers as $speaker) 
                            <option {{old('speaker')==$speaker->id?'selected':''}} value="{{$speaker->id}}">{{$speaker->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">Global Zone</label>
                          <select class="form-control select2" multiple name="global_zone[]">
                            @foreach(\Config::get('const.global_zones') as $gzone) 
                            <option value="{{$gzone}}">{{$gzone}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" class="form-control" name="title" value="{{old('title')}}"  required />
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Industry / Service / Applications</label>
                          <input type="text" class="form-control" name="industry" value="{{old('industry')}}" required />
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label class="d-block" for="basic-url">Webinar Date</label> 
                          <input class="form-control datepicker" name="webinar_date" value="{{old('webinar_date')}}" type="text" readonly />
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">TimeZones</label>
                          <select class="form-control select2" name="timezone" required>
                            <option value="">Select Timezone</option>
                            @foreach($timezones as $timezone) 
                            <option {{old('timezone')==$timezone->id?'selected':''}} value="{{$timezone->id}}">{{$timezone->country_name}} ({{$timezone->time_zone_abbr}})</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Youtube Embed Link</label>
                          <input type="text" class="form-control" name="youtube" value="{{old('youtube')}}" />
                      </div>
                      <div class="col-12 file-div mb-3">
                          <label for="basic-url">Synopsis</label>
                          <textarea rows="8" class="form-control summernote" name="synopsis">{{old('synopsis')}}</textarea>
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">Status</label>
                          <select class="form-control" id="status" name="status">
                              <option {{old('status')==1?'selected':''}} value="1" >Enabled</option>
                              <option value="0">Disabled</option>
                          </select>
                      </div>
                    </div>
                    <h1>Meta</h1>
                    <div class="row">
                      
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{old('meta_tag_title')}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control" value="{{old('meta_tag_title')}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Descriprion</label>
                          <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control">{{old('meta_tag_title')}}</textarea> 
                      </div>
                  </div>

                  <div class="row mt-3">
                      <div class="col-12">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
                </form>
               
               <!--end form-->
               <!-- <p class="card-text">loremt lorem</p> -->
               <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
              </div>
          </div>
          <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>

@endsection