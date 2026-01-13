<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiaryController extends Controller
{
   public function index(Request $request)
   {

      $notes = Note::with(['user'])     
         ->withCount('comments')       
         ->get();

      $userNotes = $notes->where('user_id', auth()->id()); 

      return view('diary.index', ['notes' => $notes, 'searchMode' => false]);

   }
   public function searchAjax(Request $request)
   {
      $query = $request->q;

      $notes = Note::with('user')
         ->withCount('comments')
         ->when($query, function ($q) use ($query) {
               $q->where('title', 'like', "%{$query}%")
               ->orWhere('content', 'like', "%{$query}%");
         })
         ->latest()
         ->get();

         return response()->json(['html' => view('partials.notes', ['notes' => $notes, 'searchMode' => true])->render()]);
   }
}
