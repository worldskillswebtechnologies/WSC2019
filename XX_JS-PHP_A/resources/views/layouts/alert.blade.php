@if (session()->has('success'))
    <div class="alert alert-success mt-3">
        {{session()->get('success')}}
    </div>
@endif

@if (session()->has('danger'))
    <div class="alert alert-danger mt-3">
        {{session()->get('danger')}}
    </div>
@endif
