<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryShowcaseContent;
use Illuminate\Support\Facades\Validator;

class __GalleryShowcaseContentController extends Controller
{
    public function home(){
        $gallery_showcases = GalleryShowcaseContent::all();

        return view('gallery-showcase', compact('gallery_showcases'));
    }

    public function index(){
        $gallery_showcases = GalleryShowcaseContent::all();

        return view('admin.gallery-showcase', compact('gallery_showcases'));
    }

    public function search(Request $request){
        $search = $request->search;
        $gallery_showcases = GalleryShowcaseContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.gallery-showcase', compact('gallery_showcases'));
    }

    public function add(){
        return view('admin.gallery-showcase-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.gallery-showcase.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $gallery_showcase = new GalleryShowcaseContent;
        $gallery_showcase->sub_title = $request->sub_title;
        $gallery_showcase->title = $request->title;
        $gallery_showcase->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gallery_showcase_images', $imageName);
            $gallery_showcase->image = $imageName;
        }
    
        $gallery_showcase->save();
    
        return redirect()->route('admin.gallery-showcase.add')->with('success', 'Gallery Showcase created successfully');
    }

    public function view($id){
        $gallery_showcase = GalleryShowcaseContent::find($id);

        return view('admin.gallery-showcase-view', compact('gallery_showcase'));
    }

    public function edit($id){
        return view('admin.gallery-showcase-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $gallery_showcase = GalleryShowcaseContent::find($id);

        if(!$gallery_showcase){
            return abort(404);
        }

        $gallery_showcase->delete();

        return redirect()->route('admin.gallery-showcase.index')->with('success', 'Gallery Showcase delete successfully');
    }
}
