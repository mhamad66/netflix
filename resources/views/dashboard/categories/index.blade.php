@extends('layouts.dashboard.app')
@section('content')
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">categories</li>
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
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
            @if (auth()->user()->hasPermission('categories_create'))
            <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
              Add</a>
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
      @if ($categories->count()>0)
      {{-- start table --}}
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $index=>$category)
          <tr>
            <td>{{$index+1}}</td>
            <td>{{$category->name}}</td>
            <td>
              @if (auth()->user()->hasPermission('categories_create'))
                  
              <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-info btn-sm"><i
                  class="fa fa-edit"></i> Edit</a>
              @else
              <a href="#" disabled class="btn btn-info btn-sm"><i
                class="fa fa-edit"></i> Edit</a>
              @endif
              
                @if (auth()->user()->hasPermission('categories_create'))
                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="POST"
                  style="display: inline">
                  @csrf
                  @method('delete')
                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
                    
                @else
                <form action="" method="POST"
                  style="display: inline">
                  @csrf
                  @method('delete')
                <button type="submit" disabled class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
                    
                @endif
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $categories->links('pagination::bootstrap-4') }}

      {{-- end table --}}
      @else
      <h3> sorry no records data</h3>
      @endif
    </div>
  </div>
  <!--end row -->
</div>

@endsection