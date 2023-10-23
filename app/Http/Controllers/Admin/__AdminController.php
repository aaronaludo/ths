<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class __AdminController extends Controller
{
    public function index(){
        $users = User::where('role_id', 2)->get();

        return view('admin.admins', compact('users'));
    }

    public function search(Request $request){
        $search = $request->search;
        $users = User::where('role_id', 2)->where('email', 'like', '%' . $search . '%')->get();

        return view('admin.admins', compact('users'));
    }

    public function add(){
        return view('admin.admins-add');
    } 

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.admins.add')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->role_id = 2;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        return redirect()->route('admin.admins.add')->with('success', 'Admin created successfully');
    }

    public function view($id){
        $user = User::where('role_id', 2)->find($id);
        
        return view('admin.admins-view', compact('user'));
    }

    public function edit($id){
        $user = User::where('role_id', 2)->find($id);

        return view('admin.admins-edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.admins.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('role_id', 2)->find($id);

        if (!$user){
            return abort(404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully');
    }

    public function destroy($id){
        $user = User::where('role_id', 2)->find($id);

        if(!$user){
            return abort(404);
        }

        $user->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin delete successfully');
    }
}
