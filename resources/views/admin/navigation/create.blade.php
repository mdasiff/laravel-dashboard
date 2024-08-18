@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Navigation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Navigation</li>
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
                    <h5 class="m-0">Add Navigation</h5>
                    <a href="{{route('admin.navigation.index')}}" class="btn btn-primary" style="float:right"><i class="fa fa-list"></i>&nbsp;List</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.navigation.store')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Select Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option selected value="" >Select Level</option>
                                    <option value="0">Main Menu Item</option>
                                    <option value="1">Sub Menu Item Level 1</option>
                                    <option value="2">Sub Menu Item Level 2</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3 level-0 d-none">
                                <label for="basic-url">Select Main Menu Item</label>
                                <select class="form-control " id="level_main" name="level_main" >
                                    <option selected value="">Select Main Menu Item</option>
                                    @foreach($main_menu_items as $main_menu_item)
                                        <option value="{{$main_menu_item->id}}">{{$main_menu_item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3 level-1 d-none">
                                <label for="basic-url">Select Level</label>
                                <select class="form-control" id="level_1" name="level_1" >
                                    <option selected value="" >Select Level 1 menu Item</option>
                                    
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option selected value="link" >Link</option>
                                    <option value="file">File</option>
                                </select>
                            </div>
                            <div class="col-6 link-div mb-3">
                                <label for="basic-url">Link</label>
                                <input type="text" id="link" name="link" class="form-control" required />
                            </div>
                            <div class="col-6 file-div mb-3 d-none">
                                <label for="basic-url">File</label>
                                <input type="file" id="file" name="file" class="form-control"  />
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
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Title</label>
                                <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Keywords</label>
                                <input type="text" id="meta_tag_keyword" name="meta_tag_keyword" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Descriprion</label>
                                <textarea rows="2" cols=""  id="meta_tag_description" name="meta_tag_description" class="form-control"></textarea> 
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