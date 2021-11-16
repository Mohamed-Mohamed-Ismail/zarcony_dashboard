@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger mx-2 my-2" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif


@if( \Illuminate\Support\Facades\Session::has('success') )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
        {{\Illuminate\Support\Facades\Session::get('success')}}
    </div>
@endif
