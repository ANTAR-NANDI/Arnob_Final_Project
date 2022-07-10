<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id', 'comment', 'replied_comment', 'parent_id', 'status'];
    public function user_info()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public static function getAllComments()
    {
        return PostComment::with('user_info')->paginate(10);
    }
    public static function getAllUserComments()
    {
        return PostComment::where('user_id', auth()->user()->id)->with('user_info')->paginate(10);
    }

}
