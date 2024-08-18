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
                <h5>Edit</h5>
                <a href="{{ route('admin.webinar.index') }}" class="btn btn-primary ml-auto">Back <i class="fas fa-backward"></i></a>
              </div>
              <div class="card-body">
               <!--start form-->
               
                <form action="{{ route('admin.webinar.update', $webinar->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                      <div class="col-6 mb-3">
                          <label for="basic-url">Speakers</label>
                          <select class="form-control select2" name="speaker">
                            <option value="">Select Speakers</option>
                            @foreach($speakers as $speaker) 
                            <option {{($webinar->speaker_id == $speaker->id) ? 'selected' : ''}} value="{{$speaker->id}}">{{$speaker->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      @php
                        $global = explode(',',$webinar->global_zone);
                      @endphp
                      <div class="col-6 mb-3">
                          <label for="basic-url">Global Zone</label>
                          <select class="form-control select2" multiple name="global_zone[]">
                            @foreach(\Config::get('const.global_zones') as $gzone) 
                            <option {{(in_array($gzone, $global)) ? 'selected' : ''}} value="{{$gzone}}">{{$gzone}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" class="form-control" name="title" value="{{$webinar->title}}" required />
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Industry / Service / Applications</label>
                          <input type="text" class="form-control" name="industry" value="{{$webinar->industry}}" required />
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Webinar Date</label> 
                          <input class="form-control datepicker" name="webinar_date" value="{{date('Y-m-d h:m a', strtotime($webinar->webinar_date))}}" type="text" readonly /> 
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">TimeZones</label>
                          <select class="form-control select2" name="timezone" required>
                            <option value="">Select Timezone</option>
                            @foreach($timezones as $timezone) 
                            <option {{($webinar->timezone_id == $timezone->id) ? 'selected' : ''}} value="{{$timezone->id}}">{{$timezone->country_name}} ({{$timezone->time_zone_abbr}})</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-6 link-div mb-3">
                          <label for="basic-url">Youtube Embed Link</label>
                          <input type="text" class="form-control" name="youtube" value="{{old('youtube',$webinar->youtube)}}" />
                      </div>
                      <div class="col-12 file-div mb-3">
                          <label for="basic-url">Synopsis</label>
                          <textarea rows="8" class="form-control summernote" name="synopsis">{!! $webinar->synopsis !!}</textarea>
                      </div>
                      <div class="col-6 mb-3">
                          <label for="basic-url">Status</label>
                          <select class="form-control" id="status" name="status">
                          <option value="1" {{($webinar->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($webinar->status == 0) ? 'selected' : ''}}>Disabled</option>
                          </select>
                      </div>
                    </div>
                      <h1>Meta</h1>
                    <div class="row">
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Title</label>
                          <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control" value="{{$webinar->meta_tag_title}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Keywords</label>
                          <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" class="form-control" value="{{$webinar->meta_tag_keywords}}" />
                      </div>
                      <div class="col-6 file-div mb-3">
                          <label for="basic-url">Descriprion</label>
                          <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control">{{$webinar->meta_tag_description}}</textarea> 
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