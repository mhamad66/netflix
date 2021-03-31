@extends('layouts.dashboard.app')
@section('content')
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
      <li class="breadcrumb-item active">roles</li>
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
              <input type="text" name="search" autofocus class="form-control" placeholder="search" value="{{request()->search}}">
              </div>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
          @if (auth()->user()->hasPermission('roles_create'))
          <a href="{{route('dashboard.roles.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
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
@if ($roles->count()>0)
  {{-- start table --}}
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">permissions</th>
        <th scope="col">usersCount</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($roles as $index=>$role)
      <tr>     
        <td>{{$index+1}}</td>
        <td>{{$role->name}}</td>
        <td>@foreach ($role->permissions as $permission)
          <span class="badge badge-primary">{{$permission->name}}</span>
          
          @endforeach</td>
          <td>{{$role->users_count}}</td>
          <td>
       @if (auth()->user()->hasPermission('roles_edit'))
           
       <a href="{{route('dashboard.roles.edit',$role->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
       @else
       <a href="#"  disabled class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
           
       @endif
       
            @if (auth()->user()->hasPermission('roles_delete'))
            <form action="{{route('dashboard.roles.destroy',$role->id)}}" method="POST" style="display: inline">
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
  
  {{ $roles->links('pagination::bootstrap-4') }}

  {{-- end table --}}
  @else
  <h3> sorry no records data</h3>
  @endif  
</div>  
</div><!--end row -->
</div>

@endsection