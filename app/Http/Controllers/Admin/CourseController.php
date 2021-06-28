<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use MediaUploader;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::get();
        return view('admin.course.all', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::get();
        return view('admin.course.create', compact('course'));
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
        $course = new Course();

        $course-> price = $request->price;
        $course-> offer = $request->offer;
        $course-> duration = $request->duration;
        $course->save();

        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/course/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
        }
        $course->photo = $imageName;

        $imageBanner = null;
        if($request->hasFile('banner')) {
            $imageBanner = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/course/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);
        }
        $course->banner = $imageBanner;

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $course->translateOrNew($locale)->title = $request->title[$locale];
                $course->translateOrNew($locale)->description = $request->description[$locale];
                $course->translateOrNew($locale)->languages = $request->languages[$locale];
                $course->translateOrNew($locale)->requirements = $request->requirements[$locale];
                $course->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $course->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $course->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $course->save();

        if($request->file('album')){
            $images = $request->file('album');
            foreach($images as $image) {
                $media = MediaUploader::fromSource($image)->upload();
                $course->attachMedia($media, 'course');
            }
        }

        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
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
        $course = Course::find($request->id);

        $course->price = $request->price;
        $course->offer = $request->offer;
        $course->duration = $request->duration;
        $course->save();

        if($request->has('image')) {
            /* dd("OK"); */
            $imageName = $course->photo;
            $destinationPath = public_path('images/course/photo/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('banner')) {
            $imageBanner = $course->banner;
            $destinationPath = public_path('images/course/banner/');
            $fullPath = $destinationPath . $imageBanner;
            Image::make($request->banner)->resize(900, 600)->save($fullPath);   
        }

        if($request->has('album')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $destinationPath = public_path('images/course/');
            $fullPath = $destinationPath . $imageName;
            Image::make($request->image)->resize(900, 600)->save($fullPath);
            $course->image = $request->imageName;
        }

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $course->translateOrNew($locale)->title = $request->title[$locale];
                $course->translateOrNew($locale)->description = $request->description[$locale];
                $course->translateOrNew($locale)->languages = $request->languages[$locale];
                $course->translateOrNew($locale)->requirements = $request->requirements[$locale];
                $course->translateOrNew($locale)->metaData = $request->metaData[$locale];
                $course->translateOrNew($locale)->metaDescription = $request->metaDescription[$locale];
                $course->translateOrNew($locale)->keywords = $request->keywords[$locale];
            }            
        }
        $course->save();
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        unlink('images/course/photo/'.$course->photo);
        unlink('images/course/banner/'.$course->banner);
        course::where('id',$id)->delete();
        return redirect()->route('course.index'); 
    }

    public function status($id) {
        $course = Course::find($id);
        if($course->status == 1) {
            $course->status = 0;
        } else {
            $course->status = 1;
        }
        $course->save();
        return redirect()->back();
    }

    public function deleteImage($id) {
        /* dd($id); */
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