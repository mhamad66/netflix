@extends('layouts.dashboard.app')
@section('content')
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">users</li>
  </ol>
</nav>
{{-- end breadcrumb --}}
<div class="tile mb-4">
  <div class="row">
    <div class="col-12">
      <form action="">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="search" autofocus class="form-control" placeholder="search"
                value="{{request()->search}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select name="role_id" id="" class="form-control">
                <option value="">All Roles</option>
                @foreach ($roles as $role)
                <option value="{{$role->id}}" {{request('role_id')==$role->id ?'selected':''}}>{{$role->name}}</option>
                @endforeach

              </select>
            </div>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
            @if (auth()->user()->hasPermission('users_create'))

            <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
            @else
            <a href="#" disabled class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>

            @endif
          </div>
        </div>
        {{-- end row --}}
      </form>
    </div>
  </div>
  {{-- end row --}}
  <div class="row">
    <div class="col-md-12">
      @if ($users->count()>0)
      {{-- start table --}}
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($users as $index=>$user)
          <tr>
            <td>{{$index+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>@foreach ($user->roles as $role)
              <span class="badge badge-primary">{{$role->name}}</span>
              @endforeach</td>
            <td>
              @if (auth()->user()->hasPermission('users_edit'))

              <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm"><i
                  class="fa fa-edit"></i> Edit</a>
              @else
              <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
              @endif
              @if (auth()->user()->hasPermission('users_delete'))
                  <form action="{{route('dashboard.users.destroy',$user->id)}}" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
              @else
                  <form action="#" method="POST" style="display: inline">
                @csrf
                @method('delete')
                <button type="submit" disabled class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $users->links('pagination::bootstrap-4') }}

      {{-- end table --}}
      @else
      <h3> sorry no records data</h3>
      @endif
    </div>
  </div>
  <!--end row -->
</div>

@endsection