<?php
namespace App\Repositories;

use App\Models\ExamStudentParticipant;
use App\Models\User;
use App\Models\UserRole;

class UserRepository{
    protected $user;
    protected $userRole;
    public function __construct(User $user,UserRole $userRole )
    {
        $this->user = $user;
        $this->userRole = $userRole;
    }


    public function login($id, $password)
    {
        $encrypted = sha1($password);
        $user = User::where('emp_id',$id)->where('password',$encrypted)->first();

        if($user==null){
            return null;
        }else{
            $userRoles = $user->roles()->get();
            if($userRoles->isEmpty()){
                return null;
            }
            return $user;
        }


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

    public function getUserStudent($username,$password)
    {
        $student = ExamStudentParticipant::where('exam_account_num',$username)
        ->where('gerated_password', $password);
        return $student;
    }
}
