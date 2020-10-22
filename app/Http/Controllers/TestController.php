<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ckeditor()
    {
        return view('ckeditor');
    }
    
    /**
     * @param Request $request
     */
    public function storeCkeditor(Request $request)
    {
        
        dd($request->all());
        
    }
    
}
