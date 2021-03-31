<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_read')->only(['index']);
        $this->middleware('permission:users_create')->only(['create','store']);
        $this->middleware('permission:users_update')->only(['edit','update']);
        $this->middleware('permission:users_delete')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // use with('roles') by solving n+1 problem
        $roles = Role::WhereRoleNot('super_admin')->get();
        $users = User::WhereSearch(request('search'))
            ->WhenRole(request('role_id'))
            ->with('roles')->whereRoleNot('super_admin')->paginate(5);
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::WhereroleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = user::create($request->all());
        $user->attachRoles(['admin', $request->role_id]);
        session()->flash('success', 'data added successfuly ');
        return redirect(route('dashboard.users.index'));
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
    public function edit(user $user)
    {
        $roles = Role::WhereroleNot(['super_admin', 'admin'])->get();

        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|numeric'
        ]);
        $user->update($request->all());
        $user->syncRoles(['admin', $request->role_id]);
        session()->flash('success', 'Data update successfuly');
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();
        session()->flash('success', 'Data deleted successfuly');
        return redirect(route('dashboard.users.index'));
    }
}
