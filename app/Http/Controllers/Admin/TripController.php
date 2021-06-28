<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use MediaUploader;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::get();
        return view('admin.trip.all', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trip = Trip::get();
        return view('admin.trip.create', compact('trip'));
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
        $trip = new Trip();

        $trip->price = $request->price;
        $trip->offer = $request->offer;
        $trip->date = $request->date;
        $trip->save();

        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/trip/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
        }
        $trip->photo = $imageName;

        $imageBanner = null;
        if($request->hasFile('banner')) {
            $imageBanner = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/trip/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);
        }
        $trip->banner = $imageBanner;

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $trip->translateOrNew($locale)->title = $request->title[$locale];
                $trip->translateOrNew($locale)->description = $request->description[$locale];
                $trip->translateOrNew($locale)->languages = $request->languages[$locale];
                $trip->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $trip->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $trip->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $trip->save();

        if($request->file('album')){
            $images = $request->file('album');
            foreach($images as $image) {
                $media = MediaUploader::fromSource($image)->upload();
                $trip->attachMedia($media, 'trip');
            }
        }

        return redirect()->route('trip.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = Trip::find($id);
        return view('admin.trip.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        /* dd($request->all()); */
        $rules = [
            'title.en'=>'required|string',
            'description.en'=>'required|string',
            'image'=>'image|mimes:png,jpg,jpeg',
            'banner'=>'image|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $trip = Trip::find($request->id);

        $trip->price = $request->price;
        $trip->offer = $request->offer;
        $trip->date = $request->date;
        $trip->save();

        if($request->has('image')) {
            $imageName = $trip->photo;
            $destinationPath = public_path('images/trip/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('banner')) {
            $imageBanner = $trip->banner;
            $destinationPath = public_path('images/trip/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);   
        }

        if($request->file('album')){
            $images = $request->file('album');
            foreach($images as $image) {
                $media = MediaUploader::fromSource($image)->upload();
                $trip->attachMedia($media, 'trip');
            }
        }

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $trip->translateOrNew($locale)->title = $request->title[$locale];
                $trip->translateOrNew($locale)->description = $request->description[$locale];
                $trip->translateOrNew($locale)->languages = $request->languages[$locale];
                $trip->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $trip->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $trip->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $trip->save();
        return redirect()->route('trip.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip = Trip::find($id);
        unlink('images/trip/photo/'.$trip->photo);
        unlink('images/trip/banner/'.$trip->banner);
        trip::where('id',$id)->delete();
        return redirect()->route('trip.index'); 
    }

    public function status($id) {
        $trip = Trip::find($id);
        if ($trip->status == 1) {
            $trip->status = 0;
        } else {
            $trip->status = 1;
        }
        $trip->save();
        return redirect()->back();
    }

    public function deleteImage($id) {
        $media = DB::table('media')->where('id',$id)->first();
        if($media){
            DB::table('media')->where('id',$id)->delete();

        }
        $path = 'images/'.$media->filename.'.'.$media->extension;
        if(file_exists($path)) {
            unlink($path);
        }else {
            echo "The file does not exist";
        }
        return redirect()->back();
    }
      
}