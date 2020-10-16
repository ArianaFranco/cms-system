<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::paginate(10);
        
        return view('admin.roles.index', compact('roles'));
        
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
        
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|min:4|max:255'
        ]);
    
        $validatedData['name'] = Str::ucfirst($validatedData['name']);
        $validatedData['slug'] = Str::slug(Str::lower(request('name')), '_');
        
        $role = Role::create($validatedData);
        $request->session()->flash('success', 'Role '.$role->name.'  was created!');
        
        return back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role) {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Role         $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {
        
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:255'
        ]);
        
        $role->name = Str::ucfirst($validatedData['name']);
        $role->slug = Str::slug(Str::lower(request('name')), '_');
        
        //The isDirty method determines if any attributes have been changed since the model was loaded.
        if($role->isDirty('name')){
            $role->update();
            $request->session()->flash('success', 'Role '.$role->name.' was updated!');
            
        }else{
            $request->session()->flash('error', 'Nothing to update!');
        }
    
        return back();
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role) {
        
        $role->delete();
        $request->session()->flash('success', 'Role was deleted!');
        return back();
    }
    
    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachPermission(Role $role){
        $role->permissions()->attach(request('permission'));
        
        return back();
    }
    
    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function detachPermission(Role $role){
        $role->permissions()->detach(request('permission'));
        
        return back();
    }
}
