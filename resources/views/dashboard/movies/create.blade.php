@extends('layouts.dashboard.app')
@section('content')

@push('styles')
<style>
    #movie_upload {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 25vh;
        flex-direction: column;
        height: 250px;
        width: 100%;
        border: 1px solid #DDD;
        cursor: pointer;
    }
</style>
@endpush

<h3>roles</h3>
{{-- start breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{Route('dashboard.roles.index')}}">roles</a></li>
        <li class="breadcrumb-item active">Add</li>
    </ol>
</nav>


{{-- end breadcrumb --}}
<div class="tile mb-4">
    <div>
        <div id="movie_upload" onclick="document.getElementById('upload').click()">
            <i class="fa fa-video-camera fa-2x p-2"></i> <span> click to upload </span> </div>
    </div>
    <input type="file" id="upload" data-movie-id='{{$movie->id}}' data-url="{{route('dashboard.movies.store')}}" style="display: none" name="">
    <form style="display:none" id="movie_properties" action="{{route('dashboard.roles.update',$movie->id)}}"
        method="POST">
        @csrf
        @method('POST')
        @include('partials._errors')
        <label for="" id="upload_state">upload</label>
        <div class="progress">
            <div class="progress-bar" id="movie_upload_progress"  role="progressbar"></div>
        </div>
        <div class="row m-5">


            <div class="col-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="input_name">
                </div>

                <div class="form-group">
                    <label>year</label>
                    <input type="text" class="form-control" name="year">
                </div>

                <div class="form-group">
                    <label>rating</label>
                    <input type="number" min="1" class="form-control" name="rating">
                </div>

                <div class="form-group">
                    <label>poster</label>
                    <input type="file" class="form-control" name="poster">
                </div>

            </div>

            <div class="col-6">
                <div class="form-group">
                    <label>description</label>
                    <textarea type="text" class="form-control" name="description"
                        style="height: 200px;  resize: none;"></textarea>
                </div>

                <div class="form-group">
                    <label>image</label>
                    <input type="file" class="form-control" name="image">
                </div>

            </div>
        </div>
        <button type="submit" id="btn_submit_publish" style="display: none" class="btn btn-primary mt-2"><i class="fa fa-plus" ></i> publish</button>

</div>
</div>

</div>
</div>
</form>
</div>
<!--End Tile -->
@endsection