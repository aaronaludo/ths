<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherSpotlightContent;
use Illuminate\Support\Facades\Validator;

class __TeacherSpotlightContentController extends Controller
{
    public function home(){
        $teacher_spotlights = TeacherSpotlightContent::all();

        return view('teacher-spotlight', compact('teacher_spotlights'));
    }

    public function index(){
        $teacher_spotlights = TeacherSpotlightContent::all();

        return view('admin.teacher-spotlight', compact('teacher_spotlights'));
    }

    public function search(Request $request){
        $search = $request->search;
        $teacher_spotlights = TeacherSpotlightContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.teacher-spotlight', compact('teacher_spotlights'));
    }

    public function add(){
        return view('admin.teacher-spotlight-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.teacher-spotlight.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $teacher_spotlight = new TeacherSpotlightContent;
        $teacher_spotlight->sub_title = $request->sub_title;
        $teacher_spotlight->title = $request->title;
        $teacher_spotlight->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/teacher_spotlight_images', $imageName);
            $teacher_spotlight->image = $imageName;
        }
    
        $teacher_spotlight->save();
    
        return redirect()->route('admin.teacher-spotlight.add')->with('success', 'Teacher Spotlight created successfully');
    }

    public function view($id){
        $teacher_spotlight = TeacherSpotlightContent::find($id);

        return view('admin.teacher-spotlight-view', compact('teacher_spotlight'));
    }

    public function edit($id){
        return view('admin.teacher-spotlight-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $teacher_spotlight = TeacherSpotlightContent::find($id);

        if(!$teacher_spotlight){
            return abort(404);
        }

        $teacher_spotlight->delete();

        return redirect()->route('admin.teacher-spotlight.index')->with('success', 'Teacher Spotlight delete successfully');
    }
}
