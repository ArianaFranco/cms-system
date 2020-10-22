<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dropzone');
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
        
        $file = $request->file('file');
        
        
        $imageInfo = $file->getClientOriginalName();
        
        $filename = pathinfo($imageInfo, PATHINFO_FILENAME);
        $extension = pathinfo($imageInfo, PATHINFO_EXTENSION);
        $imageName= Str::slug(Str::lower($filename.'-'.time().'.'.$extension), '_');
    
        $imageUpload = new Image();
    
        $imageUpload->path = $request->file->storeAs('images', $imageName);
    
        //$file->move(public_path('images'), $imageName);
        
        $imageUpload->original_filename = $filename;
        $imageUpload->filename = $imageName;
        $imageUpload->user_id = auth()->user()->id;
        $imageUpload->save();
        
        return response()->json(['success' => $imageInfo]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Image        $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $filename =  $request->get('filename');
        $image = Image::where(['filename' => $filename, 'user_id' => auth()->user()->id])->first();
        
        $path = public_path('storage/') . $image->path;
        
        if (file_exists($path)) {
            unlink($path);
            $image->delete();
        }
        
        return response()->json(['success'=>$filename]);
    }
    
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getImages()
    {
        $images = Image::all();
        $data = [];
        foreach($images as $image){
            //$tableImages[] = $image['filename'];
            
            //dd($exists = Storage::disk('local')->exists($image->path));
            if (file_exists(public_path('storage/') . $image->path)) {
                $img['name'] = $image->filename;
                $img['size'] = filesize(public_path('storage/') . $image->path); //filesize(asset('storage/' . $image->path));
                $img['path'] = asset('storage/' . $image->path);
    
                $data[] = $img;
            }
        }
  
        return response()->json($data);
    }
    
}
