<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RequestDocument;


class RequestDocumentController extends Controller
{
    public function index(){
        $userId = auth()->guard('normal')->user()->id;
    
        $requestDocuments = RequestDocument::where('user_id', $userId)->get();
    
        return view('user.request-documents', compact('requestDocuments'));
    }

    public function search(Request $request){
        $userId = auth()->guard('normal')->user()->id;
        $search = $request->input('search');
    
        $requestDocuments = RequestDocument::where('user_id', $userId)
            ->where('type_of_document', 'like', '%' . $search . '%')
            ->get();
    
        return view('user.request-documents', compact('requestDocuments'));
    }

    public function destroy($id) {
        $userId = auth()->guard('normal')->user()->id;
    
        $document = RequestDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$document) {
            return abort(404);
        }
    
        $document->delete();
    
        return redirect()->route('request-documents.index')->with('success', 'Document deleted successfully');
    }
    

    public function add(){
        return view('user.request-documents-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'type_of_document' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('request-documents.add')
                ->withErrors($validator)
                ->withInput();
        }
    
        $userId = auth()->guard('normal')->user()->id;
    
        $requestDocument = new RequestDocument;
        $requestDocument->user_id = $userId;
        $requestDocument->status_id = 1;
        $requestDocument->status_date = now();
        $requestDocument->type_of_document = $request->type_of_document;
        $requestDocument->save();
    
        return redirect()->route('request-documents.add')->with('success', 'Document created successfully');
    }    

    public function edit($id) {
        $userId = auth()->guard('normal')->user()->id;

        $requestDocument = RequestDocument::where('user_id', $userId)
            ->find($id);

        if (!$requestDocument) {
            return abort(404);
        }

        return view('user.request-documents-edit', compact('requestDocument'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'type_of_document' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('request-documents.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
    
        $userId = auth()->guard('normal')->user()->id;
    
        $requestDocument = RequestDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$requestDocument) {
            return abort(404);
        }
    
        $requestDocument->type_of_document = $request->type_of_document;
        $requestDocument->save();
    
        return redirect()->route('request-documents.index')->with('success', 'Document updated successfully');
    }    

    public function view($id) {
        $userId = auth()->guard('normal')->user()->id;
    
        $requestDocument = RequestDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$requestDocument) {
            return abort(404);
        }
    
        return view('user.request-documents-view', compact('requestDocument'));
    }
    
}
