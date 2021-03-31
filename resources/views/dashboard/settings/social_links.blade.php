@extends('layouts.dashboard.app')
@section('content')
<h3>settings</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">social links</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
    <form action="{{route('dashboard.setting.store')}}" method="POST">
        @csrf
        @method('post')
        @include('partials._errors')
        @php
            $social_sites = ['facebook','gmail','youtube'];
            @endphp

<div class="row">
@foreach ($social_sites as $social_site)
    <div class="col-6">
        <div class="form-group">
            <label class="text-capitalize">{{$social_site}} link</label>
            <input type="text" class="form-control" name={{$social_site}}"_link"
                value="{{setting($social_site.'_link')}}">
        </div>

</div>
@endforeach
</div>

<button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add</button>
</div>
</form>
</div>
<!--End Tile -->
@endsection