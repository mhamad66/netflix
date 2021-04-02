<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\streamMovie;
use App\Models\Category;
use App\Models\movie;
use Illuminate\Http\Request;

class movieController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_update')->only(['edit', 'update']);
        $this->middleware('permission:roles_delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = movie::paginate(5);
        return view('dashboard.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $movie = movie::create([]);
        return view('dashboard.movies.create', compact(['movie','categories']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $movie = movie::findOrFail($request->movie_id);
            $movie->update([
                'name'=> $request->name,
                'path'=> $request->file('movie')->store('movies')
            ]);
            $this->dispatch(new streamMovie($movie));
   return $movie;
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
    return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(movie $movie)
    {
        return view('dashboard.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, movie $movie)
    {
        $request->validate([
            'name' => 'required|unique:movies,name,' . $movie->id,

        ]);
        $movie->update($request->all());
        session()->flash('success', 'Data update successfuly');
        return redirect(route('dashboard.movies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(movie $movie)
    {

        $movie->delete();
        session()->flash('success', 'Data deleted successfuly');
        return redirect(route('dashboard.movies.index'));
    }
}
