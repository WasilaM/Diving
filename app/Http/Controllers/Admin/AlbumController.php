<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Image;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::get();
        return view('admin.album.all', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $album = Album::get();
        return view('admin.album.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title.en'=>'required|string',
            'description.en'=>'required|string',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'banner'=>'required|image|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $album = new Album();
        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/album/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
        }
        $album->photo = $imageName;

        $imageBanner = null;
        if($request->hasFile('banner')) {
            $imageBanner = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/album/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);
        }
        $album->banner = $imageBanner;
        $album->save();

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $album->translateOrNew($locale)->title = $request->title[$locale];
                $album->translateOrNew($locale)->description = $request->description[$locale];
                $album->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $album->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $album->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $album->save();

        return redirect()->route('album.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('admin.album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'title.en'=>'required|string',
            'description.en'=>'required|string',
            'image'=>'image|mimes:png,jpg,jpeg',
            'banner'=>'image|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $album = Album::find($request->id);

        if($request->has('image')) {
            $imageName = $album->photo;
            $destinationPath = public_path('images/album/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('banner')) {
            $imageBanner = $album->photo;
            $destinationPath = public_path('images/album/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);   
        }

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $album->translateOrNew($locale)->title = $request->title[$locale];
                $album->translateOrNew($locale)->description = $request->description[$locale];
                $album->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $album->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $album->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $album->save();
        return redirect()->route('album.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        unlink('images/album/photo/'.$album->photo);
        unlink('images/album/banner/'.$album->banner);
        Album::where('id',$id)->delete();
        return redirect()->route('album.index'); 
    }

    public function status($id) {
        $album = Album::find($id);
        if($album->status == 1) {
            $album->status = 0;
        } else {
            $album->status = 1;
        }
        $album->save();
        return redirect()->back();
    }
}
