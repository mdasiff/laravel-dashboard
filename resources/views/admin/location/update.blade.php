@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Locations <h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Locations</li>
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
                <div class="card-header" style="display:ruby">
                    <h5 class="m-0">Edit Location</h5>
                    <a href="{{route('admin.locations.index')}}" class="btn btn-primary" style="float:right"><i class="fa fa-list"></i>&nbsp;Country</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.locations.update', $location->id)}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                          <div class="col-6 mb-3">
                              <label for="basic-url">Title</label>
                              <input type="text" name="title" class="form-control"  value="{{$location->title}}" required />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Address 1</label>
                              <input type="text" name="address_1" class="form-control" value="{{$location->address_1}}" required />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Address 2</label>
                              <input type="text" name="address_2" class="form-control" value="{{$location->address_2}}" required />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">City</label>
                              <input type="text" name="city" class="form-control" value="{{$location->city}}" required />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Country</label>
                              <select class="form-control" id="country" name="country_id" required>
                                  <option  value="" >Select Country</option>
                                  @foreach($countries as $country)
                                    <option {{($location->country_id == $country->id) ? 'selected' : ''}} value="{{$country->id}}" >{{$country->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Zipcode</label>
                              <input type="text" name="zip" class="form-control" value="{{$location->zip}}"  />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Phone</label>
                              <input type="text" name="phone" class="form-control" value="{{$location->phone}}"  />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Fax</label>
                              <input type="text" name="fax" class="form-control" value="{{$location->fax}}"  />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Email</label>
                              <input type="email" name="email" class="form-control" value="{{$location->email}}"  />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">CIN</label>
                              <input type="text" name="cin" class="form-control" value="{{$location->cin}}"  />
                          </div>
                          
                          <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{($location->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($location->status == 0) ? 'selected' : ''}}>Disabled</option>
                                </select>
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
