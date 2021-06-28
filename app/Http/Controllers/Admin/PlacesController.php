<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Image;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::get();
        return view('admin.place.all', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $place = Place::get();
        return view('admin.place.create', compact('place'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $rules = [
            'title.en'=>'required|string',
            'description.en'=>'required|string',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'banner'=>'required|image|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $place = new Place();

        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/place/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
        }
        $place->photo = $imageName;

        $imageBanner = null;
        if($request->hasFile('banner')) {
            $imageBanner = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/place/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);
        }
        $place->banner = $imageBanner;

        $place->save();

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $place->translateOrNew($locale)->title = $request->title[$locale];
                $place->translateOrNew($locale)->description = $request->description[$locale];
                $place->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $place->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $place->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $place->save();

        return redirect()->route('place.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return view('admin.place.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /* dd($request->all()); */
        $rules = [
            'title.en'=>'required|string',
            'description.en'=>'required|string',
            'image'=>'image|mimes:png,jpg,jpeg',
            'banner'=>'image|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $place = Place::find($request->id);
        
        if($request->has('image')) {
            $imageName = $place->photo;
            $destinationPath = public_path('images/place/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('banner')) {
            $imageBanner = $place->banner;
            $destinationPath = public_path('images/place/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);   
        }

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $place->translateOrNew($locale)->title = $request->title[$locale];
                $place->translateOrNew($locale)->description = $request->description[$locale];
                $place->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $place->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $place->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $place->save();
        return redirect()->route('place.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        unlink('images/place/photo/'.$place->photo);
        unlink('images/place/banner/'.$place->banner);
        Place::where('id',$id)->delete();
        return redirect()->route('place.index'); 
    }

    public function status($id) {
        $place = Place::find($id);
        if($place->status == 1) {
            $place->status = 0;
        } else {
            $place->status = 1;
        }
        $place->save();
        return redirect()->back();
    }

}
