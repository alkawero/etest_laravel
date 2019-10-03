<?php
namespace App\Repositories;

use App\Models\Access;
use App\Models\Page;
use App\Models\Role;
use App\Models\UserRole;

class RoleRepository{
    protected $user;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getPaginate($pageNum)
    {
        $pages = Page::paginate($pageNum);
        return $pages;
    }

    public function getPages($roleId){
        $role  = Role::find($roleId);
        $pages = $role->pages()->orderBy('navigation','asc')->get();
        foreach ($pages as $page) {
            $allAccess = Access::where('page_id',$page->id)
                        ->where('role_id',$page->pivot->role_id)
                        ->pluck('access_code');                        
            $page->access = $allAccess;
               
        }
        
        return $pages;
    }

    public function getUsers($role_id){
        $role = Role::find($role_id);
        $users = $role->users()->get();
        return $users;
    }

    

    public function addUserToRole($role_id,$user_id){
        $userRole = new UserRole();
        $userRole->role_id = $role_id;
        $userRole->user_id = $user_id;
        $saved = $userRole->save();
        return $saved;
    }

    public function deleteUserRole($role_id,$user_id){
        $deleted = UserRole::where('role_id',$role_id)
        ->where('user_id',$user_id)
        ->delete();
        return $deleted;
    }

    public function toggle($id,$status){        
        $saved = Role::where('id', $id)
            ->update([
            'status' => $status
            ]);
            return $saved;
    }

    public function getById($id){
        return Role::find($id);                    
    }

    public function delete($id){
        $deleted = Role::destroy($id);                  
        return $deleted;            
    }

    
    

    
}
