<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function isAdmin(User $user)
    {
        return $user->status === 'admin';
    }
}
