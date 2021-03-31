<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles_read')->only(['index']);
        $this->middleware('permission:roles_create')->only(['create','store']);
        $this->middleware('permission:roles_update')->only(['edit','update']);
        $this->middleware('permission:roles_delete')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = role::WhereroleNot(['super_admin','admin','user'])->with(['permissions'])->withCount('users')->WhenSearch(request()->search)->paginate(5);
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.roles.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1'
        ]);
        $role = Role::create($request->all());
        $role->attachPermissions($request->permissions);
        session()->flash('success', 'data added successfuly ');
        return redirect(route('dashboard.roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        return view('dashboard.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id,
        'permissions' => 'required|array|min:1'
        
        ]);
        $role->update($request->all());
        $role->syncPermissions($request->permissions);
        session()->flash('success', 'Data update successfuly');
        return redirect(route('dashboard.roles.index'));
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {

        $role->delete();
        session()->flash('success', 'Data deleted successfuly');
        return redirect(route('dashboard.roles.index'));

    }

}
