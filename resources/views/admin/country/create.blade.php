@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Countries <h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Countries</li>
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
                    <h5 class="m-0">Add Location</h5>
                    <a href="{{route('admin.country.index')}}" class="btn btn-primary" style="float:right"><i class="fa fa-list"></i>&nbsp;Country</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.country.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                          <div class="col-6 mb-3">
                              <label for="basic-url">Name</label>
                              <input type="text" name="name" class="form-control"  value="{{old('name')}}" required />
                          </div>
                          
                          <div class="col-6 file-div mb-3">
                              <label for="basic-url">Image</label>
                              <input type="file" id="image" name="image" class="form-control"  />
                          </div>
                          <div class="col-6 mb-3">
                              <label for="basic-url">Status</label>
                              <select class="form-control" id="status" name="status">
                                  <option selected value="1" >Enabled</option>
                                  <option value="0">Disabled</option>
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
