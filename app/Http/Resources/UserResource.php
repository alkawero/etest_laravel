<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     protected  $userRepo;
     protected  $roleRepo;
     protected  $user;
    public function __construct(User $user,RoleRepository $roleRepo,UserRepository $userRepo )
    {
        $this->roleRepo = $roleRepo;
        $this->userRepo = $userRepo;
        $this->user = $user;
        
    }

    public function toArray($request)
    {
                
        $userRoles = $this->user->roles()->get();
        $pages = [];
        foreach($userRoles as $userRole){
            $pgs = $this->roleRepo->getPages($userRole->id);
            foreach($pgs as $pg){
                array_push($pages,$pg);
            }
        }
        $uniquePages = getUniqueArrayById($pages);

        return [
            'id' => $this->user->emp_id,
            'name' => $this->user->emp_name,
            'roles' => $userRoles,
            'pages' => $uniquePages            
        ];
    }
}
