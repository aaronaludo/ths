<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicCalendarContent;
use Illuminate\Support\Facades\Validator;

class __AcademicCalendarContentController extends Controller
{
    public function home(){
        $academic_calendars = AcademicCalendarContent::all();

        return view('academic-calendar', compact('academic_calendars'));
    }

    public function index(){
        $academic_calendars = AcademicCalendarContent::all();

        return view('admin.academic-calendar', compact('academic_calendars'));
    }

    public function search(Request $request){
        $search = $request->search;
        $academic_calendars = AcademicCalendarContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.academic-calendar', compact('academic_calendars'));
    }

    public function add(){
        return view('admin.academic-calendar-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.academic-calendar.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $academic_calendar = new AcademicCalendarContent;
        $academic_calendar->sub_title = $request->sub_title;
        $academic_calendar->title = $request->title;
        $academic_calendar->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/academic_calendar_images', $imageName);
            $academic_calendar->image = $imageName;
        }
    
        $academic_calendar->save();
    
        return redirect()->route('admin.academic-calendar.add')->with('success', 'Academic Calendar created successfully');
    }

    public function view($id){
        $academic_calendar = AcademicCalendarContent::find($id);

        return view('admin.academic-calendar-view', compact('academic_calendar'));
    }

    public function edit($id){
        return view('admin.academic-calendar-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $academic_calendar = AcademicCalendarContent::find($id);

        if(!$academic_calendar){
            return abort(404);
        }

        $academic_calendar->delete();

        return redirect()->route('admin.academic-calendar.index')->with('success', 'Academic Calendar delete successfully');
    }
}
