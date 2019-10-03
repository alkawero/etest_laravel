<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Http\Resources\UserIdText;
use App\Http\Resources\UserMappingResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;
    protected $roleRepo;
    

    public function __construct(UserRepository $userRepo,RoleRepository $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        
    }


    public function getById($id)
    {
        $user = User::find($id);   
        if($user==null){
            return 'user not found';
        } 
        return new UserResource($user,$this->roleRepo,$this->userRepo);   
        
        
    }

    public function getByParams(Request $request)
    {
        if($request->keyword){
            return UserIdText::collection($this->userRepo->getLike($request->keyword));
        }
        return $this->userRepo->getUser()->paginate($request->pageNum);         

    }




    
    



}
