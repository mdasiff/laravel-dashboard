@if(Session::has('success'))
<div class="alert alert-success">
	<i class="fa fa-check-circle"></i> {{Session::get('success')}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">
	<i class="fa fa-check-circle"></i> {{Session::get('error')}}
</div>
@endif
@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif