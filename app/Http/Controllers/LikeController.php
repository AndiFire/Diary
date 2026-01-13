<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Comment;

class LikeController extends Controller
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
      $model = $request->type === 'note'
         ? Note::findOrFail($request->id)
         : Comment::findOrFail($request->id);

      $existing = $model->likes()->where('user_id', auth()->id())->first();
      if ($existing) {
         $existing->delete();
      } else {
         $model->likes()->create(['user_id' => auth()->id()]);
      }

      return response()->json([
         'likes_count' => $model->likes()->count()
      ]);
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      
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

   public function search(Request $request)
   {
      $query = $request->get('query');
      $userId = $request->get('user_id');

      return Note::where('user_id', $userId)
         ->where('title', 'like', "%{$query}%")
         ->orWhere('content', 'like', "%{$query}%")
         ->get();
   }
}
