<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(5);
        foreach($banners as $banner){
            $banner->status = $banner->expire_date>now()?'Active':'Expired';
        };
        return view('admin.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image"=>['required','mimes:png,jpg,jpeg'],
            "url"=>['url'],
            "expire_date"=>['required','date','after:today']
        ]);
        //move image to public
        $file = $request->file('image');
        $fileName = uniqid().$file->getClientOriginalName();
        $file->move(public_path('assets/image/banners'),$fileName);
        Banner::create([
            "image"=>$fileName,
            "url"=>$request->url,
            "expire_date"=>$request->expire_date
        ]);
        return redirect()->route('admin.banners.index')->with('success',"Banner is created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->back()->with("success","Successfully deleted.");
    }
}
