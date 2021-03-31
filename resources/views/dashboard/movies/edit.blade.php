@extends('layouts.dashboard.app')
@section('content')
<h3>roles</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{Route('dashboard.roles.index')}}">roles</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
    <form action="{{route('dashboard.roles.update',$role->id)}}" method="POST">
        @csrf
        @method('PUT')
        @include('partials._errors')
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name',$role->name)}}">
                </div>

            </div>
        </div>

        <div class="row">
            <h4 class="mt-3">permissions</h4>
            <table class="table col-12">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Model</th>
                        <th scope="col">permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $models = ['categories','users'];
                    @endphp
                    @foreach ($models as $index=>$model)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$model}}</td>
                        <td>
                            @php
                            $permission_maps = ['create','read','update','delete'];
                            @endphp
                            <select name="permissions[]" class="form-control select2" multiple>
                                @foreach ($permission_maps as $permission_map)
                                <option 
                                value="{{$model . '_' . $permission_map}}"
                                {{$role->hasPermission($model . '_' . $permission_map) ? 'selected': ''}}
                                >
                                    
                                    {{$permission_map}}</option>

                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-edit"></i> Edit</button>
    </form>
</div>
<!--End Tile -->
@endsection