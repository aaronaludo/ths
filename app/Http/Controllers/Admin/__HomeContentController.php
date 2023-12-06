<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use Illuminate\Support\Facades\Validator;

class __HomeContentController extends Controller
{
    public function home(){
        $homes = HomeContent::all();

        return view('index', compact('homes'));
    }

    public function index(){
        $homes = HomeContent::all();

        return view('admin.home', compact('homes'));
    }

    public function search(Request $request){
        $search = $request->search;
        $homes = HomeContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.home', compact('homes'));
    }

    public function add(){
        return view('admin.home-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.home.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $home = new HomeContent;
        $home->sub_title = $request->sub_title;
        $home->title = $request->title;
        $home->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/home_images', $imageName);
            $home->image = $imageName;
        }
    
        $home->save();
    
        return redirect()->route('admin.home.add')->with('success', 'Home created successfully');
    }

    public function view($id){
        $home = HomeContent::find($id);

        return view('admin.home-view', compact('home'));
    }

    public function edit($id){
        return view('admin.home-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $home = HomeContent::find($id);

        if(!$home){
            return abort(404);
        }

        $home->delete();

        return redirect()->route('admin.home.index')->with('success', 'Home delete successfully');
    }
}
