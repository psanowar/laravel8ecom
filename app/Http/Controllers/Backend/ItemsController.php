<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Items;
use App\Models\Backend\Gallery;
use File;
use Image;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Items::all();
        return view('backend.pages.item.manageitem',compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.item.additem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->pic){
            $image=$request->file('pic');
            $customName=rand().'.'.$image->getClientOriginalExtension();
            $location=public_path('backend/items/'.$customName);
            Image::make($image)->save($location);

            $item= new Items();
            $item->item_code = $request->item_code;
            $item->name = $request->name;
            $item->des = $request->des;
            $item->pic = $customName;
            $item->save();
            // dd($item);

        }
        if($request->gallery){
            $galleryImages=$request->file('gallery');
            foreach($galleryImages as $galleryImage){
                $gallerycustomName=rand().'.'.$galleryImage->getClientOriginalExtension();
                $location1=public_path('backend/items/gallery/'.$gallerycustomName);
                Image::make($galleryImage)->save($location1);

                $gallery = new Gallery();
                $gallery->item_code = $request->item_code;
                $gallery->gallery = $gallerycustomName;
                $gallery->save();
                // dd($gallery);
            }

            return redirect()->route('item.manage');
        }
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
        $items=Items::find($id);
        $gallery=Gallery::where('item_code', $items->item_code)->get();
        return view('backend.pages.item.edititem',compact("items","gallery"));
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
        //
    }

    public function updatesingImage(Request $request, $id)
    {
        $gallery=Gallery::find($id);

        if(File::exists('backend/items/gallery/'.$gallery->gallery)){
            File::delete('backend/items/gallery/'.$gallery->gallery);
        }
        
        $image=$request->file($id);
        $customName=rand().'.'.$image->getClientOriginalExtension();
        $location=public_path('backend/items/gallery/'.$customName);
        Image::make($image)->save($location);

        $gallery->gallery=$customName;
         $gallery->update();
        // dd($image);
         return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items=Items::find($id);

        if(File::exists('backend/items/'.$items->pic)){
            File::delete('backend/items/'.$items->pic);
        }

        $galleryImages=Gallery::where('item_code',$items->item_code)->get();
        
        foreach($galleryImages as $galleryImage){
            
            if(File::exists('backend/items/gallery/'.$galleryImage->gallery)){
                File::delete('backend/items/gallery/'.$galleryImage->gallery);
            }

            $deleteImagedata=Gallery::find($galleryImage->id);
            $deleteImagedata->delete();

        }
        $items->delete();
        return redirect()->route('item.manage');
    }
    public function deletesingleImage($id)
    {
        $galleryImages=Gallery::find($id);

        if(File::exists('backend/items/gallery/'.$galleryImages->gallery)){
            File::delete('backend/items/gallery/'.$galleryImages->gallery);
        }
        $galleryImages->delete();
        return back();
    }
    
}
