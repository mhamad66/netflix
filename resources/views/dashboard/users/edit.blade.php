@extends('layouts.dashboard.app')
@section('content')
<h3>users</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{Route('dashboard.users.index')}}">users</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
    <form action="{{route('dashboard.users.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('partials._errors')
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name',$user->name)}}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email',$user->email)}}">
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{$user->hasRole($role->name)?'selected':''}}>{{$role->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add</button>

    </form>
</div> 
<!--End Tile -->
@endsection