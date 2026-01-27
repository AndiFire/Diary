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
      $comments = $note->comments()->whereNull('parent_id')->with([
         'user',
         'children' => function ($query) {
            $query->with([
               'user',
               'likes',
               'children' => function ($subQuery) {
                  $subQuery->with(['user', 'likes'])->withCount('likes');
               }
            ])->withCount('likes');
         },
         'likes'
      ])->withCount(['likes', 'children'])->withExists([
               'likes as user_liked' => function ($query) {
                  $query->where('user_id', auth()->id());
               }
            ])->get();

      $comments->each(function ($comment) {
         $comment->children->each(function ($child) {
            $child->user_liked = $child->likes->contains('user_id', auth()->id());
            $child->children->each(function ($grandchild) {
               $grandchild->user_liked = $grandchild->likes->contains('user_id', auth()->id());
            });
         });
      });

      return response()->json([
         'comments' => $comments,
         'note_author_id' => $note->user_id
      ]);
   }

   public function create()
   {

   }

   public function store(Request $request, Note $note)
   {
      $validated = $request->validate([
         'content' => 'required|string|max:5000',
         'parent_id' => 'nullable|exists:comments,id',
      ]);

      $comment = $note->comments()->create([
         'user_id' => auth()->id(),
         'content' => $validated['content'],
         'parent_id' => $validated['parent_id'] ?? null,
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
