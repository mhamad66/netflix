@extends('layouts.dashboard.app')
@section('content')
<h3>users</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{Route('dashboard.users.index')}}">users</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
    <form action="{{route('dashboard.users.store')}}" method="POST">
        @csrf
        @method('post')
        @include('partials._errors')
        <div class="row">
            <div class="col-6 ">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>password confirmation</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>

        <a href="{{route('dashboard.roles.create')}}">Create A new Role</a> <br>
        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus"></i> Add</button>
    </div>
</div>
</form>
</div>
<!--End Tile -->
@endsection