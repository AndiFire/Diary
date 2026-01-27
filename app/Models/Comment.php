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
      'parent_id',
   ];

   public static array $rules = [
      'content' => ['required', 'string', 'max:5000'],
   ];
   protected $appends = ['created_comment', 'updated_comment'];

   public function getCreatedCommentAttribute()
   {
      return $this->created_at?->diffForHumans();
   }

   public function getUpdatedCommentAttribute()
   {
      return $this->updated_at?->diffForHumans();
   }

   public function note()
   {
      return $this->belongsTo(Note::class);
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function likes()
   {
      return $this->morphMany(Like::class, 'likeable');
   }

   public function parent()
   {
      return $this->belongsTo(Comment::class, 'parent_id');
   }

   public function children()
   {
      return $this->hasMany(Comment::class, 'parent_id');
   }
}
