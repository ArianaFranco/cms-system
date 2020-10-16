<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::paginate(5);
        
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        
        //Using the UserPolicy
        $this->authorize('view', $user);
        
        return view('admin.users.profile', compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //Using the UserPolicy
        $this->authorize('view', $user);
        $roles = Role::all();
    
        return view('admin.users.profile', compact('user', 'roles'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User         $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        
        $validatedData = $request->validate([
            'name'     => ['required', 'string', 'min:6', 'max:255'],
            'surname'  => ['required', 'string', 'min:6', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'max:15', 'alpha_dash'],
            'email'    => ['required', 'string', 'email', 'max:255']
            //'password' => ['min:8', 'max:255', 'confirmed']
        ]);
        
        
        if($request->has('avatar')) {
            $validatedData['avatar'] = $request->avatar->storeAs('images',
                $request->file('avatar')->getClientOriginalName()
            );
        }
    
        $user->update($validatedData);
    
        $request->session()->flash('success', 'User was updated!');
    
        return back();
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request) {
        //Using the UserPolicy
        //$this->authorize('delete', $user);
    
        $user->delete();
        $request->session()->flash('success', 'User has been deleted!');
        return back();
    }
    
    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachRole(User $user){
        $user->roles()->attach(request('role'));
        
        return back();
    }
    
    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachRole(User $user){
        $user->roles()->detach(request('role'));
        
        return back();
    }
}
