<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutContent;
use Illuminate\Support\Facades\Validator;

class __AboutContentController extends Controller
{
    public function home(){
        $abouts = AboutContent::all();

        return view('about', compact('abouts'));
    }

    public function index(){
        $abouts = AboutContent::all();

        return view('admin.about', compact('abouts'));
    }

    public function search(Request $request){
        $search = $request->search;
        $abouts = AboutContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.about', compact('abouts'));
    }

    public function add(){
        return view('admin.about-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.about.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $about = new AboutContent;
        $about->sub_title = $request->sub_title;
        $about->title = $request->title;
        $about->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/about_images', $imageName);
            $about->image = $imageName;
        }
    
        $about->save();
    
        return redirect()->route('admin.about.add')->with('success', 'About created successfully');
    }

    public function view($id){
        $about = AboutContent::find($id);

        return view('admin.about-view', compact('about'));
    }

    public function edit($id){
        return view('admin.about-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $about = AboutContent::find($id);

        if(!$about){
            return abort(404);
        }

        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About delete successfully');
    }
}
