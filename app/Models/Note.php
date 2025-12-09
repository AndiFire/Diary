<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $content
 * @property bool $published
 * @property Carbon $published_at
 */
class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title', 'content',
        'published', 'published_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    public static array $rules = [
        'title' => ['required', 'string', 'max:100'],
        'content' => ['required', 'string', 'max:10000'],
        'published_at' => ['nullable', 'string', 'date'],
        'published' => ['nullable', 'boolean'],
    ];

   public function isPublished(): bool
   {
      return $this->published && $this->published_at;
   }

   public function user()
   {
      return $this->belongsTo(User::class, 'user_id');
   }
   public function comments()
   {
      return $this->hasMany(Comment::class);
   }  

   public function likes() {
      return $this->morphMany(Like::class, 'likeable');
   }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty()) {
                $model->updated_at = $model->freshTimestamp();
            }
        });
    }
}
