<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show home page
    public function home()
    {
        return view('index');
    }
    //Show register form
    public function register()
    {
        return view('users.register', [
            'departments' => Department::select('id', 'name')
                        -> get(),
            'courses' => Course::select('id', 'name')
                    -> get()
        ]);
    }
    //Store user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'type' => 'required',
            'name' => ['required', 'min:3'],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        User::create($formFields);

        $users = User::select('id')
                    -> where('email', '=', $formFields['email'])
                    -> get();
        //Creates accounts by roles
        foreach($users as $user)
        {
            switch($formFields['type'])
            {
                case 1: Admin::create([
                            'user_id' => $user->id,
                            'name' => $formFields['name'],
                        ]);
                        break;
                case 3: Faculty::create([
                            'user_id' => $user->id,
                            'name' => $formFields['name'],
                            'department_id' => $request['department_id']
                        ]);
                        break;
                case 4: Student::create([
                            'user_id' => $user->id,
                            'name' => $formFields['name'],
                            'course_id' => $request['course_id']
                        ]);
                        break;
            }
        }

        return redirect('/login')->with('message', 'User registered.');
    }
    //Show login form
    public function login()
    {
        return view('users.login');
    }
    //Authenticate user
    public function auth(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields))
        {
            $types = User::select('type')
                        -> where('email', '=', $formFields['email'])
                        -> get();

            foreach($types as $type)
                $role = $this->checkRole($type->type);

            $request->session()->regenerate();

            return redirect('/' . $role)->with('message', 'You are now logged in.');
        }
        else
            return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }
    //Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out.');
    }
    //check role
    public function checkRole($type)
    {
        switch($type)
        {
            case 1: return 'admin';
                    break;
            case 2: return 'sast';
                    break;
            case 3: return 'faculty';
                    break;
            case 4: return 'student';
        }
    }
}
