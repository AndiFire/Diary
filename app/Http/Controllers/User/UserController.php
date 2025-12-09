<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {

    }



    public function edit(User $user)
    {
        return view('user.edit');
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        //
    }

    //    --------------Change Name-----------------
    public function ChangeName(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'new_name' => ['required', 'confirmed', 'string', 'max:50'],

        ]);
        $user = Auth::user();

        $user->name = $request->new_name;
        $user->save();
        Session::flash('success', 'Name Changed Successfully');
        return redirect()->route('profile.show');
    }

//    --------------Change Password-----------------
    public function ChangePassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:8', 'max:55',  Rules\Password::defaults()],

        ]);
        $user = Auth::user();

//         The passwords matches
        if (!Hash::check($request->current_password, auth()->user()->password))
        {
            throw ValidationException::withMessages(['old_password' => 'The old password is incorrect.']);
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0)
        {
            throw ValidationException::withMessages(['error_cannot_be_same' => "New Password cannot be same as your current password."]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        Session::flash('success', 'Password Changed Successfully');
        return redirect()->route('profile.show');
    }
}
