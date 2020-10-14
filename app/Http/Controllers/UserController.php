<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        return view('admin.users.profile', compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        //
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
    public function destroy(User $user) {
        //
    }
}
