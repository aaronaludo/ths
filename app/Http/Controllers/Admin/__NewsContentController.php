<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsContent;
use Illuminate\Support\Facades\Validator;

class __NewsContentController extends Controller
{
    public function home(){
        $news = NewsContent::all();

        return view('news', compact('news'));
    }

    public function index(){
        $news = NewsContent::all();

        return view('admin.news', compact('news'));
    }

    public function search(Request $request){
        $search = $request->search;
        $news = NewsContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.news', compact('news'));
    }

    public function add(){
        return view('admin.news-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.news.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $new = new NewsContent;
        $new->sub_title = $request->sub_title;
        $new->title = $request->title;
        $new->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/new_images', $imageName);
            $new->image = $imageName;
        }
    
        $new->save();
    
        return redirect()->route('admin.news.add')->with('success', 'News created successfully');
    }

    public function view($id){
        $new = NewsContent::find($id);

        return view('admin.news-view', compact('new'));
    }

    public function edit($id){
        return view('admin.news-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $new = NewsContent::find($id);

        if(!$new){
            return abort(404);
        }

        $new->delete();

        return redirect()->route('admin.news.index')->with('success', 'News delete successfully');
    }
}
