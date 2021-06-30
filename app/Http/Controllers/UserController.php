<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('id','ASC')->get();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('users-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'user_name'      => 'required|string|max:255',
            // 'user_email'     => 'required|string|email|max:255|unique:users',
            // 'user_address'   => 'required|string|max:255',
            'user_mobile'    => 'required|digits:11'
            // 'user_password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'address' => $request->user_address,
            'password' => Hash::make($request->user_password),
            'mobile' => $request->user_mobile,
            'level' => $request->user_level,
        ]);
        return redirect(route('users'))->with('alert', 'User Created!');;
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // 'user_name'      => 'required|string|max:255',
            // 'user_email'     => 'required|string|email|max:255|unique:users',
            // 'user_address'   => 'required|string|max:255',
            'user_mobile'    => 'required|digits:11'
            // 'user_password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::find($request->user_no)->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'address' => $request->user_address,
            'mobile' => $request->user_mobile,
            'level' => $request->user_level,
        ]);


        if($request->user_password) {
            $validated = Hash::make($request->user_password);
            User::find($request->user_no)->update(['password' => $validated]);
        }

        return redirect(route('users.edit',$request->user_no))->with('alert', 'User Updated!');
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect(route('users'))->with('alert', 'User Deleted!');
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        return view('profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'user_mobile'    => 'required|digits:11'
        ]);

        User::find($request->user_no)->update([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'address' => $request->user_address,
            'mobile' => $request->user_mobile,
        ]);

        if($request->user_password) {
            $validated = Hash::make($request->user_password);
            User::find($request->user_no)->update(['password' => $validated]);
        }

        return redirect(route('profile',$request->user_no))->with('alert', 'Profile Updated!');
    }
}
?>