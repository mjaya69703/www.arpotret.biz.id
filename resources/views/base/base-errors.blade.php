@extends('base.base-admin-index')
@section('content')
    
@if(Str::is('errors-verify', request()->path()))
<div class="card mb-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span style="font-size: 20px">{{ $submenu }}</span>
        <span class="align-items-center">
            <a href="" class="btn btn-outline-warning btn-rounded"><i class="fa-solid fa-right-to-bracket"></i> ReFresh</a>
        </span>
    </div>
    <div class="card-body">
        <span class="text-white" style="font-size: 20px">Your account is not verify. please wait</span>
    </div>
</div>
{{-- PAGES FOR ERROR ACCESS --}}
@elseif(Str::is('errors-access', request()->path()))
<div class="card mb-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span style="font-size: 20px">{{ $submenu }}</span>
        <span class="align-items-center">
            <a href="" class="btn btn-outline-warning btn-rounded"><i class="fa-solid fa-right-to-bracket"></i> ReFresh</a>
        </span>
    </div>
    <div class="card-body">
        <span class="text-white" style="font-size: 20px">Your account cant access this pages. Please back to <a href="/" class="text-danger">Home</a></span>
    </div>
</div>
{{-- END IF --}}
@endif
@endsection