@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contact Queries</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @if(Session::has('message'))
          <div class="alert alert-danger">{{Session::get('message')}}</div>
          @endif
          
        <div class="row">
          


          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <h5 class="">List ({{$queries->count()}})</h5>
                <!-- <div class="btn-group ml-auto">
                  <a href="{{ route('admin.webinar.create') }}" class="btn btn-primary">Create <i class="fas fa-plus"></i></a>
                </div> -->
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
                      <th>Query Page</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Job Title</th>
                      <th>Company</th>
                      <th>Country</th>
                      <th>Query At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($queries as $key => $query)
                    <tr>
                      <td>{{  $key + 1 }}</td>
                      <td>
                        
                        @php $qp = str_replace(route('welcome'), '', $query->query_page) @endphp

                        <a href="{{$query->query_page}}#common-query-form-wrapper" target="_blank">
                          {{$qp=='/'?'/home':$qp}}
                        </a>

                      </td>
                      <td>{{ $query->first_name }}</td>
                      <td>{{ $query->last_name }}</td>
                      <td>{{ $query->email }}</td>
                      <td>{{ $query->contact }}</td>
                      <td>{{ $query->job_title }}</td>
                      <td>{{ $query->company }}</td>
                      <td>{{ $query->country }}</td>
                      <td>{{ $query->created_at->format('d-M, Y') }}</td>
                      <td>
                        <a href="{{route('admin.query.contact.delete',$query->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to permanently delete this query?')"><i class="fa fa-trash"></i></a>
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