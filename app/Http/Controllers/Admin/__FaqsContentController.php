<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqsContent;
use Illuminate\Support\Facades\Validator;

class __FaqsContentController extends Controller
{
    public function home(){
        $faqs = FaqsContent::all();

        return view('faqs', compact('faqs'));
    }

    public function index(){
        $faqs = FaqsContent::all();

        return view('admin.faqs', compact('faqs'));
    }

    public function search(Request $request){
        $search = $request->search;
        $faqs = FaqsContent::where('title', 'like', '%' . $search . '%')->get();

        return view('admin.faqs', compact('faqs'));
    }

    public function add(){
        return view('admin.faqs-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.faqs.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $faq = new FaqsContent;
        $faq->sub_title = $request->sub_title;
        $faq->title = $request->title;
        $faq->description = $request->description;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/faqs_images', $imageName);
            $faq->image = $imageName;
        }
    
        $faq->save();
    
        return redirect()->route('admin.faqs.add')->with('success', 'FAQs created successfully');
    }

    public function view($id){
        $faq = FaqsContent::find($id);

        return view('admin.faqs-view', compact('faq'));
    }

    public function edit($id){
        return view('admin.faqs-edit');
    }

    public function update(Request $request, $id){
        return 'update';
    }

    public function destroy($id){
        $faq = FaqsContent::find($id);

        if(!$faq){
            return abort(404);
        }

        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQs delete successfully');
    }
}
