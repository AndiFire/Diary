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
      // $comments = $note->comments()->with('user');



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
      $query = $request->get('q') ?? $request->get('search', '');
      $userId = $request->get('user_id') ?? auth()->id();

      $notesQuery = Note::where('user_id', $userId)
         ->when($userId !== Auth::id(), function ($query){
            $query->where('published', true);
         });

      if (!empty($query)) {
         $notesQuery->where(function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
               ->orWhere('content', 'like', "%{$query}%");
         });
      }

      $notes = $notesQuery->get();

      return response()->json(['notes' => $notes]);
   }
}
