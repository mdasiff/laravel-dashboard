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
                    <h5 class="m-0">Edit Navigation</h5>
                    <a href="{{route('admin.navigation.index')}}" class="btn btn-primary" style="float:right"><i class="fa fa-list"></i>&nbsp;List</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.navigation.update', $navigation->id)}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="basic-url">Select Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="" >Select Level</option>
                                    <option value="0" {{($navigation->level == 0) ? 'selected' : ''}}>Main Menu Item</option>
                                    <option value="1" {{($navigation->level == 1) ? 'selected' : ''}}>Sub Menu Item Level 1</option>
                                    <option value="2" {{($navigation->level == 2) ? 'selected' : ''}}>Sub Menu Item Level 2</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3 level-0 {{($navigation->level == 1 || $navigation->level == 2) ? '' : 'd-none'}} ">
                                <label for="basic-url">Select Main Menu Item</label>
                                <select class="form-control " id="level_main" name="level_main" >
                                    <option selected value="">Select Main Menu Item</option>
                                    @foreach($main_menu_items as $main_menu_item)
                                        <option {{($navigation->main_menu_id == $main_menu_item->id) ? 'selected' : ''}} value="{{$main_menu_item->id}}">{{$main_menu_item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3 level-1 {{($navigation->level == 2) ? '' : 'd-none'}}">
                                <label for="basic-url">Select Level</label>
                                <select class="form-control" id="level_1" name="level_1" >
                                    @foreach($level1_menu_items as $level1_menu_item)
                                        <option {{($navigation->parent_id == $level1_menu_item->id) ? 'selected' : ''}} value="{{$level1_menu_item->id}}" >{{$level1_menu_item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Name</label>
                                <input type="text" name="name" class="form-control" value="{{$navigation->name}}" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="link" {{($navigation->type == 'link') ? 'selected' : ''}}>Link</option>
                                    <option value="file" {{($navigation->type == 'file') ? 'selected' : ''}}>File</option>
                                </select>
                            </div>
                            <div class="col-6 link-div mb-3 {{($navigation->type == 'link') ? '' : 'd-none'}}">
                                <label for="basic-url">Link</label>
                                <input type="text" id="link" name="link" class="form-control" value="{{$navigation->link}}" />
                            </div>
                            <div class="col-6 file-div mb-3 {{($navigation->type == 'file') ? '' : 'd-none'}}">
                                <label for="basic-url">File</label>
                                <input type="file" id="file" name="file" class="form-control"  />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{($navigation->status == 1) ? 'selected' : ''}}>Enabled</option>
                                    <option value="0" {{($navigation->status == 0) ? 'selected' : ''}}>Disabled</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="basic-url">Sort</label>
                                <input type="number" name="sort" value="{{$navigation->sort}}" class="form-control" required />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Title</label>
                                <input type="text" id="meta_tag_title" name="meta_tag_title" value="{{$navigation->meta_tag_title}}" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Keywords</label>
                                <input type="text" id="meta_tag_keywords" name="meta_tag_keywords" value="{{$navigation->meta_tag_keywords}}" class="form-control"  />
                            </div>
                            <div class="col-6 file-div mb-3">
                                <label for="basic-url">Meta Tag Descriprion</label>
                                <textarea rows="4" cols=""  id="meta_tag_description" name="meta_tag_description"  class="form-control">{{$navigation->meta_tag_description}}</textarea> 
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