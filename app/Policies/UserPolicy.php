<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function before(User $user)
    {
        if($user->role == "0")
        {
            return true;
        }
    }
    public function update(User $check,User $user)
    {
        if($check->id !== $user->id)
        {
            return abort(401);
        }else
        {
            return true;
        }
    }
    public function view(User $check,User $user)
    {
        if($check->id !== $user->id)
        {
            return abort(401);
        }else
        {
            return true;
        }
    }
    public function showButton(User $check,User $user)
    {
        return $check->id === $user->id;
    }
}
