<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

   protected $fillable = [
      'user_id',
      'note_id',
      'content',
   ];

   public static array $rules = [
      'content' => ['required', 'string', 'max:5000'],
   ];

   public function note()
   {
   return $this->belongsTo(Note::class);
   }

   public function user()
   {
   return $this->belongsTo(User::class);
   }
   
   public function likes() {
      return $this->morphMany(Like::class, 'likeable');
   }
}
