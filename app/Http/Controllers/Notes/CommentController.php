<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Comment;

class CommentController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index(Note $note)
   {

      return response()->json($note->comments()->with('user')->withCount('likes')->withExists([
         'likes as user_liked' => function ($query) {
            $query->where('user_id', auth()->id());
         }
      ])->get());
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

   public function update(Request $request, Note $note, Comment $comment)
   {
      abort_unless($comment->note_id === $note->id, 404);
      abort_unless($comment->user_id === auth()->id(), 403);

      $request->validate([
         'content' => 'required|string|max:1000',
      ]);

      $comment->update([
         'content' => $request->input('content'),
      ]);

      return response()->json([
         'content' => $comment->content,
         'updated_at' => $comment->updated_at,
         'updated_comment' => $comment->updated_at->diffForHumans(),
      ]);
   }
   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Note $note, Comment $comment)
   {
      if ($comment->user_id !== auth()->id()) {
         return response()->json(['error' => 'Unauthorized'], 403);
      }

      $comment->likes()->delete();
      $comment->delete();

      return response()->json(['message' => 'Comment deleted']);
   }
}
