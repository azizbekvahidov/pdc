<?php

namespace App\Http\Controllers\Admin;

use App\Groups;
use App\UserAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Str;

class UsersController extends Controller {
    public function index(){
        if(\Auth::user()->role_id == '1') {
            $users = User::orderBy("role_id","asc")->get();
            return view('admin.users.index',['users' => $users]);
        }
        else{
            $groups = Groups::where('teacher_id',\Auth::user()->id)->get();
//            dd($groups);
            return view('admin.users.indexTeacher',['groups' => $groups]);
        }
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        \Validator::make($request->all(), [
            'login'     => 'required',
            'name'      => 'required|max:15',
            'surname'   => 'required|max:17',
            'email'     => 'required',
            'tel'       => 'required|min:13|max:13',
            'password'  => 'required|confirmed|min:6'
        ])->validate();

        $user           = new User();
        $user->login    = $request->login;
        $user->name     = $request->name;
        $user->surname  = $request->surname;
        $user->email    = $request->email;
        $user->tel      = $request->tel;
        $user->password = bcrypt($request->password);
        $user->role_id  = $request->role_id;
        $user->save();

        return redirect()->route('admin.users.index')->with('message', 'Пользователь создан');
    }
    public function edit($id){
        $user = User::find($id);

        return view('admin.users.edit', ['user' => $user]);
    }

    public function update($id, Request $request){

        $validate = \Validator::make($request->all(), [
            'name' => 'required|min:3',
            'art_name' => 'required|min:20',
        ]);

        if($validate->fails()){
            if($request->ajax()){
                return response()->json(['errors' => $validate->messages()]);
            }
            return redirect()
                            ->route('admin.users.edit', $id)
                            ->withErrors($validate);
        }

        $user = User::find($id);

        $user->name  = $request->name;
        $user->slug  = Str::slug($request->name);
        $user->art_name  = $request->art_name;

        $user->save();

        return redirect()->route('admin.users.index')->with('message', 'Author updated!');
    }

    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('message', 'Author deleted!');
    }

    public function results($id) {
        $user = User::find($id);
//        dd($user->answers);
        return view('admin.users.results',['user' => $user]);
    }

    public function role(Request $request){
        $role = User::find($request->id);
        $role->role_id = $request->role_id;
        $role->save();

        switch ($request->role_id){
            case '1':
                $role = 'Админ';
                break;
            case '2':
                $role = 'Учитель';
                break;
            default:
                $role = 'Студент';
                break;
        }

        return response(['text' => 'Changed successfully','id' => $role]);
    }

    public function profile($id) {
        $user = User::find($id);

        return view('admin.users.profile.index',['user' => $user]);
    }
}
