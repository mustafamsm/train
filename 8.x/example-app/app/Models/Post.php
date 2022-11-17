<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
class Post extends Model{
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $fillable = [
        'title',
        'description',
         
    ];
   
    public function comments() 
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
