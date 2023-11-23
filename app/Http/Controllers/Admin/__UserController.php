<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class __UserController extends Controller
{
    public function index(){
        $users = User::where('role_id', 1)->get();

        return view('admin.users', compact('users'));
    }

    public function search(Request $request){
        $search = $request->search;
        $users = User::where('role_id', 1)->where('email', 'like', '%' . $search . '%')->get();

        return view('admin.users', compact('users'));
    }

    public function add(){
        return view('admin.users-add');
    } 

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.add')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->role_id = 1;
        $users->name = $request->name;
        $users->archive = 0;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        return redirect()->route('admin.users.add')->with('success', 'User created successfully');
    }

    public function view($id){
        $user = User::where('role_id', 1)->find($id);
        
        return view('admin.users-view', compact('user'));
    }

    public function edit($id){
        $user = User::where('role_id', 1)->find($id);

        return view('admin.users-edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('role_id', 1)->find($id);

        if (!$user){
            return abort(404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id){
        $user = User::where('role_id', 1)->find($id);

        if(!$user){
            return abort(404);
        }

        $trackDocuments = $user->track_documents;

        foreach ($trackDocuments as $trackDocument) {
            $trackDocument->recipients()->delete();
        }

        $user->track_documents()->delete();
        $user->request_documents()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User delete successfully');
    }

    public function archive($id){
        $user = User::where('role_id', 1)->find($id);
        $success = '';

        if(!$user){
            return abort(404);
        }
 
        if($user->archive == 1){
            $user->archive = 0;
            $success = 'unarchive';
        }else if($user->archive == 0){
            $user->archive = 1;
            $success = 'archive';
        };

        $user->save();

       return redirect()->route('admin.users.index')->with('success', 'User '.$success.' successfully');
    }
}
