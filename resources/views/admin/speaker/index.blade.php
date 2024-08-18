@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Speakers</h1>
          </div><!-- /.col -->
          <!-- /.col -->
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
                <h5 class="">List ({{$speakers->count()}})</h5>
                <div class="btn-group ml-auto">
                  <a href="{{ route('admin.speaker.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="card-body">
               @if(Session::has('success'))
               <div class="alert alert-success">{{Session::get('success')}}</div>
               @endif
               @if(Session::has('updated'))
               <div class="alert alert-success">{{Session::get('updated')}}</div>
               @endif
               <!--start table-->
               <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Sr. No</th>
                        <th>Speaker</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($speakers as $key => $speaker)
                      <tr>
                        <td>{{  $key + 1 }}</td>
                        <td>
                          <div class="mb-3 image-wrapper"><img src="{{ $speaker->image }}"></div>
                          <div>{{ $speaker->name }}</div>
                        </td>
                        <td>{{ $speaker->email }}</td>
                        <td>{{ $speaker->designation }}</td>
                        <td>{{ $speaker->created_at->format('d-M, Y') }}</td>
                        
                        <td>
                            <a href="{{ route('admin.speaker.edit', $speaker) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i> Edit</a>
                        </td>

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
               <!--end table-->
            
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
  @endsection