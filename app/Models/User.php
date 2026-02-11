<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable implements MustVerifyEmail
{
   use HasApiTokens, HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'name',
      'email',
      'password',
      'avatar',
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
      'password',
      'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
   ];

   public function getAvatarUrlAttribute()
   {
      return $this->avatar
         ? asset('storage/' . $this->avatar)  
         : asset('images/default-avatar.jpg'); 
   }


   public function notes(){
      return $this->hasMany(Note::class);
   }

   public function likedNotes()
   {
      return $this->morphedByMany(
         Note::class,       
         'likeable',        
         'likes',            
         'user_id',          
         'likeable_id'       
      );
   }
      public function commentedNotes()
   {
      return $this->belongsToMany(
         Note::class,
         'comments',
         'user_id',
         'note_id'
      )->withPivot('content')->distinct();
   }

}
