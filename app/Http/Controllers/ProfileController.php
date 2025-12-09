<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = auth()->user();

        $notes = Note::all();
        $current_userid = auth()->user()->id;
        $userinfo = User::find($current_userid);
        $userprofile = User::where('id', $current_userid)->first();

        foreach ($notes as $note) {
            $user = Note::find($note->user_id);
            $note->user_name = $user ? $user->name : 'Неизвестно';
        }

        return view('profile.show', compact('userprofile', 'userinfo', 'notes', 'note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
