<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Category;
use Image;
use File;
class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory=Subcategory::all();
        return view('backend.pages.subcategory.managesubcategory', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catname=Category::all();
        return view('backend.pages.subcategory.addsubcategory', compact('catname'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'catId'=>'required',
            'name'=>'required',
            'des'=>'required',
            'image'=>'required',
            'status'=>'required'
        ]);

        $subcategoryname= new Subcategory();
        $subcategoryname->catId = $request->catId;
        $subcategoryname->subcatName = $request->name;
        $subcategoryname->slug = Str::slug($request->name);
        $subcategoryname->des = $request->des;
        $subcategoryname->status = $request->status;

        if($request->image){
            $image = $request->file('image');
            $nameCustom=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('backend/subcategoryimages/'.$nameCustom);
            $check=Image::make($image)->save($location);
            $subcategoryname->img=$nameCustom;
        }
        $subcategoryname->save();
        return redirect()->route('subcategorymanage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $subcategory=Subcategory::find($id);
        $catname=Category::all();
        return view('backend.pages.subcategory.editsubcategory', compact('subcategory','catname'));
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
        $subcategory=Subcategory::find($id);
       
        $subcategory->catId = $request->catId;
        $subcategory->subcatName = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->des = $request->des;
        $subcategory->status = $request->status;

        if(!empty($request->image)){
            if(File::exists('backend/subcategoryimages/'.$subcategory->img)){
                File::delete('backend/subcategoryimages/'.$subcategory->img);
            }
            $image = $request->file('image');
            $nameCustom=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('backend/subcategoryimages/'.$nameCustom);
            $check=Image::make($image)->save($location);
            $subcategory->img=$nameCustom;
        }
        $subcategory->update();
        return redirect()->route('subcategorymanage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $subcategory=Subcategory::find($id);
        File::delete('backend/subcategoryimages/'.$subcategory->img);
        $subcategory->delete();
        return redirect()->route('subcategorymanage');    
    }
}
