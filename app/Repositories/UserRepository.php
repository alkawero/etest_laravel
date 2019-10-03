<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\UserRole;

class UserRepository{
    protected $user;
    protected $userRole;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
    
    public function getUserRoles($userId)
    {
        $user = User::find($userId);
        $roles = $user->roles()->get();
        return $roles;
    }

    public function getLike($keyword)
    {
        $users = User::where('emp_id', 'like', '%'.$keyword.'%')
        ->orWhere('emp_name', 'like', '%'.$keyword.'%')->simplePaginate(10);
        return $users;
    }
}
