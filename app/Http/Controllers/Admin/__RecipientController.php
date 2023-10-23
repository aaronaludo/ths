<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class __RecipientController extends Controller
{
    public function index(){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $users = User::whereIn('role_id', $roles)->get();

        return view('admin.recipients', compact('users'));
    }

    public function search(Request $request){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $search = $request->search;
        $users = User::whereIn('role_id', $roles)->where('email', 'like', '%' . $search . '%')->get();

        return view('admin.recipients', compact('users'));
    }

    public function add(){
        return view('admin.recipients-add');
    } 

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.recipients.add')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->role_id = $request->role;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        return redirect()->route('admin.recipients.add')->with('success', 'Recipient created successfully');
    }

    public function view($id){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $user = User::whereIn('role_id', $roles)->find($id);
        
        return view('admin.recipients-view', compact('user'));
    }

    public function edit($id){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $user = User::whereIn('role_id', $roles)->find($id);

        return view('admin.recipients-edit', compact('user'));
    }

    public function update(Request $request, $id){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.'|email',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.recipients.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::whereIn('role_id', $roles)->find($id);

        if (!$user){
            return abort(404);
        }

        if($request->password){
            $user->password = $request->password;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->save();

        return redirect()->route('admin.recipients.index')->with('success', 'Recipient updated successfully');
    }

    public function destroy($id){
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $user = User::whereIn('role_id', $roles)->find($id);

        if(!$user){
            return abort(404);
        }

        $user->delete();

        return redirect()->route('admin.recipients.index')->with('success', 'Recipient delete successfully');
    }
}
