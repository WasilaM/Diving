<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = Level::get();
        return view('admin.level.all', compact('level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = Level::get();
        return view('admin.level.create', compact('level'));
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
            'title.en'=>'required|string'
        ];
        $request->validate($rules);
        $level = new Level();
        $level->save();

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if($request->title[$locale])
            {
                $level->translateOrNew($locale)->title = $request->title[$locale];
            }            
        }
        $level->save();

        return redirect()->route('level.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::find($id);
        return view('admin.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'title.en'=>'required|string'
        ];
        $request->validate($rules);
        $level = Level::find($request->id);

        foreach (\LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if ($request->title[$locale]) {
                $level->translateOrNew($locale)->title = $request->title[$locale];
            }
        }
        $level->save();
        return redirect()->route('level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $level = Level::find($id);
        unlink('images/level/photo/'.$level->photo);
        unlink('images/level/banner/'.$level->banner);
        level::where('id',$id)->delete();
        return redirect()->route('level.index'); 
    }

    public function status($id) {
        $level = Level::find($id);
        if($level->status == 1) {
            $level->status = 0;
        } else {
            $level->status = 1;
        }
        $level->save();
        return redirect()->back();
    }
}
