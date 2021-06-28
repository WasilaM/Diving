<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Image;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::get();
        return view('admin.activity.all', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activity = Activity::get();
        return view('admin.activity.create', compact('activity'));
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
        $activity = new Activity();

        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/activity/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
        }
        $activity->photo = $imageName;

        $imageBanner = null;
        if($request->hasFile('banner')) {
            $imageBanner = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/activity/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);
        }
        $activity->banner = $imageBanner;

        $activity->save();

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $activity->translateOrNew($locale)->title = $request->title[$locale];
                $activity->translateOrNew($locale)->description = $request->description[$locale];
                $activity->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $activity->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $activity->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $activity->save();

        return redirect()->route('activity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        return view('admin.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
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
        $activity = Activity::find($request->id);
        
        if($request->has('image')) {
            $imageName = $activity->photo;
            $destinationPath = public_path('images/activity/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('banner')) {
            $imageBanner = $activity->banner;
            $destinationPath = public_path('images/activity/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);   
        }

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $activity->translateOrNew($locale)->title = $request->title[$locale];
                $activity->translateOrNew($locale)->description = $request->description[$locale];
                $activity->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $activity->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $activity->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $activity->save();
        return redirect()->route('activity.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        unlink('images/activity/photo/'.$activity->photo);
        unlink('images/activity/banner/'.$activity->banner);
        activity::where('id',$id)->delete();
        return redirect()->route('activity.index'); 
    }

    public function status($id) {
        $activity = activity::find($id);
        if($activity->status == 1) {
            $activity->status = 0;
        } else {
            $activity->status = 1;
        }
        $activity->save();
        return redirect()->back();
    }
}
