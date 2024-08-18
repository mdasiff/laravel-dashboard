@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Blog Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blog Category</li>
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
                    <h5 class="">Create</h5>
                    <div class="btn-group ml-auto">
                      <a href="{{ route('admin.blog-category.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.blog-category.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            
                            <div class="col-6 mb-3">
                                <label for="basic-url">Title</label>
                                <input type="text" name="title" class="form-control" required />
                            </div>

                            <div class="col-6 mb-3">
                                <label for="basic-url">Slug</label>
                                <input type="text" name="slug" class="form-control" required />
                            </div>

                            <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option selected value="1" >Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Sort</label>
                                <input type="number" name="sort" value="0" class="form-control" required />
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
    $(document).ready(function() {
        $("#level").on("change",function(){
            if($(this).val() == 1) {
                $('.level-0').removeClass('d-none');
                $('.level-0 #level_main').attr('required', true);

                $('.level-1').addClass('d-none');
                $('.level-1 #level_1').attr('required', false);
            } else if($(this).val() == 2) {
                $('.level-0').removeClass('d-none');
                $('.level-0 #level_main').attr('required', true);

                $('.level-1').removeClass('d-none');
                $('.level-1 #level_1').attr('required', true);
            } else {
                $('.level-0').addClass('d-none');
                $('.level-0 #level_main').attr('required', false);

                $('.level-1').addClass('d-none');
                $('.level-1 #level_1').attr('required', false);
            }
        });

        $("#type").on("change",function(){
            if($(this).val() == 'file') {
                $('.file-div').removeClass('d-none');
                $('.file-div #file').attr('required', true);

                $('.link-div').addClass('d-none');
                $('.link-div #link').attr('required', false);
            } else {
                $('.file-div').addClass('d-none');
                $('.file-div #file').attr('required', false);

                $('.link-div').removeClass('d-none');
                $('.link-div #link').attr('required', true);
            }
        });

        $(document.body).on("change","#level_main",function(){
            var val = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{route('admin.navigation.get_level_1_list')}}",
                data: {"val": val, "_token": "{{ csrf_token() }}"},
                dataType: "html",
                success: function(resultData){
                    $('#level_1').html(resultData);
                }
            });
            return false;
        });
    });

</script>
@endpush