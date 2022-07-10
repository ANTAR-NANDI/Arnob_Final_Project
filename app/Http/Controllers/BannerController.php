<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Image;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('id', 'DESC')->paginate(10);
        return view('backend.banner.index')->with('banners', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
            'photo' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $data = new Banner();
        $title = $request->title;
        $slug = Str::slug($request->title);
        $count = Banner::where('slug', $title)->count();
        if ($count > 0) {
            $slug = $request->title . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data->slug = $slug;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        //upload image
        if ($request->hasfile('photo')) {
            $originalImage = $request->file('photo');
            $thumbnailImage = Image::make($originalImage);
            $time = time();
            $thumbnailPath = public_path() . '/uploads/thumbnail/banners/';
            $originalPath = public_path() . '/uploads/images/banners/';
            $thumbnailImage->save($originalPath . $time . $originalImage->getClientOriginalName());
            $thumbnailImage->resize(150, 150);
            $thumbnailImage->save($thumbnailPath . $time . $originalImage->getClientOriginalName());
            $data->photo = $time . $originalImage->getClientOriginalName();
        }
        $status = $data->save();
        if ($status) {
            request()->session()->flash('success', 'Banner successfully added');
        } else {
            request()->session()->flash('error', 'Error occurred while adding banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit')->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required|max:50',
            'description' => 'string|nullable',
            // 'photo' => 'required',
            'status' => 'required|in:active,inactive',
        ]);
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->status = $request->status;
        $title = $request->title;
        $slug = Str::slug($request->title);
        $count = Banner::where('slug', $title)->count();
        if ($count > 0) {
            $slug = $request->title . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $banner->slug = $slug;
        if ($request->hasfile('photo')) {
            if (file_exists(public_path() . '/uploads/thumbnail/banners/' . $banner->photo)) {
                unlink(public_path() . '/uploads/thumbnail/banners/' . $banner->photo);
            }
            if (file_exists(public_path() . '/uploads/images/banners/' . $banner->photo)) {
                unlink(public_path() . '/uploads/images/banners/' . $banner->photo);
            }
            $originalImage = $request->file('photo');
            //dd($originalImage);
            $thumbnailImage = Image::make($originalImage);
            $time = time();
            $thumbnailPath = public_path() . '/uploads/images/banners/';
            $originalPath = public_path() . '/uploads/thumbnail/banners/';
            $thumbnailImage->save($originalPath . $time . $originalImage->getClientOriginalName());
            $thumbnailImage->resize(150, 150);
            $thumbnailImage->save($thumbnailPath . $time . $originalImage->getClientOriginalName());
            $banner->photo = $time . $originalImage->getClientOriginalName();
        }
            // dd($banner);
            $status = $banner->save();
            if ($status) {
                request()->session()->flash('success', 'Banner successfully updated');
            } else {
                request()->session()->flash('error', 'Error occurred while updating banner');
            }
            return redirect()->route('banner.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $status = $banner->delete();
        if ($status) {
            request()->session()->flash('success', 'Banner successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
