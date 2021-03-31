@extends('layouts.dashboard.app')
@section('content')
<h3>settings</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">social login</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
    <form action="{{route('dashboard.setting.store')}}" method="POST">
        @csrf
        @method('post')
        @include('partials._errors')
        @php
            $social_sites = ['facebook','gmail'];
            @endphp

<div class="row">
@foreach ($social_sites as $social_site)
    <div class="col-6">
        <div class="form-group">
            <label class="text-capitalize">{{$social_site}} client id</label>
            <input type="text" class="form-control" name={{$social_site}}"_client_id"
                value="{{setting($social_site.'_client_id')}}">
        </div>

        <div class="form-group">
            <label class="text-capitalize"> {{$social_site}} client secret</label>
            <input type="text" class="form-control" name= {{$social_site}}"_client_id"
                value="{{setting($social_site.'_client_secret')}}">
        </div>

        <div class="form-group">
            <label class="text-capitalize">{{$social_site}} redirect url</label>
            <input type="text" class="form-control" name={{$social_site}}"_redirect_url"
                value="{{setting($social_site.'_redirect_url')}}">
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