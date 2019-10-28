<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Http\Resources\UserIdText;
use App\Http\Resources\UserMappingResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserStudentResource;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $userRepo;
    protected $roleRepo;


    public function __construct(UserRepository $userRepo,RoleRepository $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;

    }

    public function login(Request $request)
    {

        $user = $this->userRepo->login($request->username,$request->password);

        if($user===null){
            return Response::json(['error' => 'user not found'], 200);
        }
        return new UserResource($user,$this->roleRepo,$this->userRepo);


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

    public function getUserStudent(Request $request)
    {
        $student =   $this->userRepo->getUserStudent($request->username, $request->password)->first();

        if($student!==null){
            return new UserStudentResource($student, $this->roleRepo);
        }
        return $student;
    }











}
