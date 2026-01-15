<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use App\Models\Comment;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

   public function index(Request $request, Note $note)
   {
      $notes = Note::all();

      return view('user.notes.index', compact('notes'));
   }


   public function create()
   {
      return view('user.notes.create');
   }


   public function store(Request $request)
   {

      $data = $request->validate([
         'title' => ['required', 'string', 'max:155'],
         'content' => ['required', 'string', 'max:10000'],
         'published_at' => ['nullable', 'string', 'date'],
         'published' => ['nullable', 'boolean'],
      ]);

      $note = Note::firstOrCreate(
         [
            'user_id' => auth()->id(),
            'title' => $data['title'],
         ],
         [
            'content' => $data['content'],
            'published_at' => new Carbon($data['published_at'] ?? null),
            'published' => $data['published'] ?? false,

         ]
      );

      return redirect()->route('diary');
   }


   public function show(Note $note, Comment $comment)
   {
      $note->loadCount('likes')
         ->loadExists([
            'likes as user_liked' => function ($query){
               $query->where('user_id', auth()->id());
            }
         ]);

      return view('user.notes.show', compact(['note']));
   }


   public function edit(Note $note)
   {
      return view('user.notes.edit', compact('note'));
   }

   public function update(Request $request, string $id)
   {
      $validated = $request->validate([
         'title' => ['required', 'string', 'max:155'],
         'content' => ['required', 'string', 'max:10000'],
         'published' => ['nullable', 'boolean'],
      ]);

      $note = Note::findOrFail($id);
      $note->title = $request->input('title');
      $note->content = $request->input('content');
      $note->published = $request->input('published') ?? false;

      $note->updated_at = now();

      $note->save();

      return redirect()->route('diary');
   }

   public function delete(string $id)
   {
      $note = Note::findOrFail($id);

      $note->delete();

      return redirect()->route('diary');
   }

   public function search(Request $request)
   {
      $queryText = $request->get('q') ?? $request->get('search', '');
      $userId = $request->get('user_id') ?? auth()->id();
      $type = $request->get('type', 'all'); 

      $notesQuery = Note::query();

      if ($type === 'liked') {
         $notesQuery->whereHas('likes', function($q) use ($userId) {
               $q->where('user_id', $userId);
         });
      } else {
         $notesQuery->where('user_id', $userId);

         if ($userId != auth()->id()) {
               $notesQuery->where('published', true);
         }
      }

      if (!empty($queryText)) {
         $notesQuery->where(function($q) use ($queryText) {
               $q->where('title', 'like', "%{$queryText}%")
               ->orWhere('content', 'like', "%{$queryText}%");
         });
      }

      $notes = $notesQuery->withCount('likes')
         ->orderBy('published_at', 'desc')
         ->get();

      return response()->json(['notes' => $notes]);
   }

}
