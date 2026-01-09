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
      // $categories = [
      //     null => __('Все категории'), 
      //     1 => __('Первая категория'), 
      //     2 => __('Вторая категория'),
      // ];
   
      //     $validated = $request->validate([
      //         'search' => ['nullable', 'string', 'max:55'],
      //         'from_date' => ['nullable', 'string', 'date'],
      //         'to_date' => ['nullable', 'string', 'after:from_date'],
      //         'tag' => ['nullable', 'string', 'max:15'],
      //     ]);
   
      //     $query = Note::query()
      //         ->where('published', true)
      //         ->whereNotNull('published_at');
   
      //     if ($search = $validated['search'] ?? null) {
      //         $query->where('title', 'like', "%{$search}%");
      //     }
   
      //     if ($fromDate = $validated['from_date'] ?? null) {
      //         $query->where('published_at', '>=', new Carbon($fromDate));
      //     }
   
      //     if ($toDate = $validated['to_date'] ?? null) {
      //         $query->where('published_at', '<=', new Carbon($toDate));
      //     }
   
      //     if ($tag = $validated['tag'] ?? null) {
      //         $query->whereJsonContains('tags', $tag);
      //     }
   
      //         $notes = $query->latest('published_at')
      //         ->paginate(12);


      $notes = Note::with(['user'])     
         ->withCount('comments')       
         ->get();

      $userNotes = $notes->where('user_id', auth()->id()); 

      return view('diary.index', compact('notes', 'userNotes'));

   }
}
