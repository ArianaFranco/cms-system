<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
    
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|min:4|max:255'
        ]);
    
        $validatedData['name'] = Str::ucfirst($validatedData['name']);
        $validatedData['slug'] = Str::slug(Str::lower(request('name')), '_');
    
        $permission = Permission::create($validatedData);
        $request->session()->flash('success', 'Permission '.$permission->name.'  was created!');
    
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
    
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:255'
        ]);
    
        $permission->name = Str::ucfirst($validatedData['name']);
        $permission->slug = Str::slug(Str::lower(request('name')), '_');
    
        //The isDirty method determines if any attributes have been changed since the model was loaded.
        if($permission->isDirty('name')){
            $permission->update();
            $request->session()->flash('success', 'Permission '.$permission->name.' was updated!');
        
        }else{
            $request->session()->flash('error', 'Nothing to update!');
        }
    
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();
        $request->session()->flash('success', 'Permission was deleted!');
        return back();
    }
}
