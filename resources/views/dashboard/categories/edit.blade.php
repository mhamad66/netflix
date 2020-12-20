@extends('layouts.dashboard.app')
@section('content')
<h3>categories</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
      <li class="breadcrumb-item "><a href="{{Route('dashboard.categories.index')}}">Categories</a></li>
      <li class="breadcrumb-item active">Edit</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
<form action="{{route('dashboard.categories.update',$category->id)}}" method="POST">
@csrf
@method('PUT')
@include('partials._errors')
<div class="row">
        <div class="col-6">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name',$category->name)}}">
            <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-edit"></i> Edit</button>
            </div>
            </div>
    </div>
</form>
    </div><!--End Tile -->
@endsection