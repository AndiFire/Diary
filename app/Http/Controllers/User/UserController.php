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
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {

   }

   public function create()
   {
      //
   }

   public function store(Request $request)
   {
      //
   }

   public function show(Request $request, Note $note, $id)
   {
      $user = User::where('id', $id)->firstOrFail();

      if (auth()->check() && auth()->id() === (int) $id) {
         $notes = Note::where('user_id', $id)->get();
      } else {
         $notes = Note::where('user_id', $id)->where('published', true)->get();
      }

      $publishedNotes = Note::where('published', true)->get();
      $commentedNotes = $user->commentedNotes()->with('user')->get();
      $likedNotes = $user->likedNotes()->with('user')->get();

      return view('user.show', compact('user', 'publishedNotes', 'commentedNotes', 'likedNotes', 'notes'));
   }

   public function edit($id)
   {

      if (auth()->id() !== (int) $id) {
         abort(403);
      }

      $user = auth()->user();

      $notes = Note::where('user_id', $id)->get();

      return view('user.edit', compact('user', 'notes'));
   }

   public function update(Request $request, string $id)
   {
   }

   public function destroy(string $id)
   {
      //
   }

   //    --------------Change Name-----------------
   public function changeName(Request $request): RedirectResponse
   {
      $request->validate([
         'new_name' => ['required', 'string', 'max:50'],
      ]);

      $user = Auth::user();
      $user->name = $request->new_name;
      $user->save();

      return redirect()->route('user.edit', ['id' => $user->id])
         ->with('success', 'Name changed successfully');

   }

   //    --------------Change Password-----------------
   public function ChangePassword(Request $request): RedirectResponse
   {
      $this->validate($request, [
         'current_password' => ['required'],
         'new_password' => ['required', 'confirmed', 'min:8', 'max:55', Rules\Password::defaults()],

      ]);
      $user = Auth::user();

      //         The passwords matches
      if (!Hash::check($request->current_password, auth()->user()->password)) {
         throw ValidationException::withMessages(['old_password' => 'The old password is incorrect.']);
      }

      // Current password and new password same
      if (strcmp($request->get('current_password'), $request->new_password) == 0) {
         throw ValidationException::withMessages(['error_cannot_be_same' => "New Password cannot be same as your current password."]);
      }

      $user->password = Hash::make($request->new_password);
      $user->save();
      Session::flash('success', 'Password Changed Successfully');
      return redirect()->route('user.edit');
   }

   public function changeAvatar(Request $request)
   {
      $request->validate([
         'avatar' => 'required|image|max:2048',
      ]);

      $user = Auth::user();

      if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
         Storage::disk('public')->delete($user->avatar);
      }

      $path = $request->file('avatar')->store('avatars', 'public');

      $user->avatar = $path;
      $user->save();

      return response()->json([
         'avatar_url' => asset('storage/' . $path),
      ]);
   }
}