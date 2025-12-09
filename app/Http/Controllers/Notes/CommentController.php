<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Note $note)
   {

      return response()->json($note->comments()->with('user')->get());
   }

    public function create()
   {

   }

   public function store(Request $request, Note $note)
   {
      $validated = $request->validate([
         'content' => 'required|string|max:5000',
      ]);

      $comment = $note->comments()->create([
         'user_id' => auth()->id(),
         'content' => $validated['content'],
      ]);

      return response()->json($comment->load('user'));
   }

    public function show(Note $note)
    {

    }

    public function edit(string $id)
    {
        //
    }

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
