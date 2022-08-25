<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function reactors()
    {
        return $this->belongsToMany(User::class);
    }
    public function unReacted()
    {
        return $this->reactors()->detach(Auth::id());
    }
    public function reacted()
    {
        return $this->reactors()->attach(Auth::id());
    }
}
