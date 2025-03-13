<?php
namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'notifier_id', 'post_id', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifier()
    {
        return $this->belongsTo(User::class, 'notifier_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function clear()
    {
        static::query()->delete();
    }

    public function comment()
    {
        return $this->hasOne(Comment::class, 'post_id', 'post_id')
            ->where('user_id', $this->notifier_id)
            ->latest();
    }

}
