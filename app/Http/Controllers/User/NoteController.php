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
   /**
    * Display a listing of the resource.
    */
   public function index(Request $request, Note $note)
   {
      $notes = Note::all();

      return view('user.notes.index', compact('notes'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return view('user.notes.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request){

      $data = $request->validate([
         'title' => ['required', 'string', 'max:155'],
         'content' => ['required', 'string', 'max:10000'],
         'published_at' => ['nullable', 'string', 'date'],
         'published' => ['nullable', 'boolean'],
      ]);

      $note = Note::firstOrCreate([
         'user_id' => auth()->id(),
         'title' => $data['title'],
      ],
      [
         'content' => $data['content'],
         'published_at' => new Carbon($data['published_at'] ?? null),
         'published' => $data['published'] ?? false,

      ]);

      return redirect()->route('diary');
   }

   /**
    * Display the specified resource.
    */
   public function show(Note $note, Comment $comment)
   {

      // $comments = $note->comments()->with('user')

      return view('diary.notes.show', compact(['note']));
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Note $note)
   {
      return view('user.notes.edit', compact('note'));
   }

   /**
    * Update the specified resource in storage.
    */
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

   /**
    * Remove the specified resource from storage.
    */
   public function delete(string $id)
   {
      $note = Note::findOrFail($id);

      $note->delete();

      return redirect()->route('diary');
   }
}
