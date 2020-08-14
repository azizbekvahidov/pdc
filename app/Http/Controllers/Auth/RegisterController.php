<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\{Courses, User, Groups};

class RegisterController extends Controller
{

		use RegistersUsers;


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request) {


        $courses = Courses::where('countdown_time','>',date('Y/m/j', time()))->get();
        return view('auth.register',[
            'courses' => $courses,
            'request' => $request->all(),
        ]);

    }

    public function register(Request $request)
    {
        \Validator::make($request->all(), [
            'login'         => 'required',
            'name'          => 'required',
            'surname'       => 'required',
            'email'         => 'unique:users',
            'tel'           => 'required',
            'courses'       => 'required',
            'password'      => 'required|confirmed',
        ])->validate();

        event(new Registered($user = $this->create($request->all())));

        foreach ($request->courses as $course) {
            $group = Groups::whereStart(null)->where('course_id', $course)->first();
            
            \App\GroupsStudents::firstOrCreate(['group_id' => $group->id, 'user_id' => $user->id, 'user_status' => '0']);
        }
        
        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
    public function create($request)
    {
        return User::create([
            'login'         => $request['login'],
            'name'          => $request['name'],
            'surname'       => $request['surname'],
            'email'         => $request['email'],
            'tel'           => $request['tel'],
            'password'      => bcrypt($request['password']),
            'role_id'       => $request['role_id'],
        ]);
    }
}
