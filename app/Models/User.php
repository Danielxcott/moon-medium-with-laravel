<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
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
    ];

    public function scopeFilter($q,$filter)
    {
        $q->when($filter["search_user"]??false,function($q,$search){
            $q->where("username","like","%$search%")
            ->orWhere("name","like","%$search%");
        });
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function article()
    {
        return $this->hasOne(Article::class);
    }
 
    public function isOnline()
    {
        return Cache::has("user-is-online-" . $this->id);
    }

    public function reactedArticle()
    {
        return $this->belongsToMany(Article::class);
    }

    public function isReacted($article)
    {
        return Auth::user()->reactedArticle && Auth::user()->reactedArticle->contains("id",$article->id);
    }

    public function userRequests()
    {
        return $this->hasMany(UserRequest::class);
    }
    public function userRequest()
    {
        return $this->hasOne(UserRequest::class);
    }

    public function isSent($userId)
    {
        return Auth::user()->userRequests && Auth::user()->userRequests->contains("friend_id",$userId);
    }
    
}
