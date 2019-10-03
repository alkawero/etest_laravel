<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserMappingResource;
use App\Models\Access;
use App\Models\Page;
use App\Repositories\RoleRepository;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{

    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
        
    }

    public function all(){        
        $roles = Role::all();
        return $roles;                
    }

    public function getById($id){
        return $this->roleRepo->getById($id);                    
    }

    public function delete(Request $request){
        $deleted = $this->roleRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);        
    }

    public function create(Request $request){        
        $role = new Role();
        $role->code = $request->code;
        $role->name = $request->name;
        $role->desc = $request->desc;
        $role->status = $request->status;
        $saved = $role->save();
        if($saved){
            return Response::json(['success' => $saved], 200);
        } 
    }

    public function update(Request $request){        
        $saved = DB::table('roles')
            ->where('id', $request->id)
            ->update([
            'code' => $request->code,
            'name' => $request->name,
            'desc' => $request->desc,
            'status' => $request->status
            ]);

            return Response::json(['success' => $saved], 200);
    }

    public function addPageAccess(Request $request){        
        $access = new Access();
        $access->role_id = $request->role_id;
        $access->page_id = $request->page_id;
        $access->access_code = $request->access_code;

        $saved = $access->save();
            return Response::json(['success' => $saved], 200);
    }

    public function addUserToRole(Request $request){  
        $saved = $this->roleRepo->addUserToRole($request->role_id,$request->user_id);
            return Response::json(['success' => $saved], 200);
    }

    public function deleteUserRole(Request $request){  
        $deleted = $this->roleRepo->deleteUserRole($request->role_id,$request->user_id);
            return Response::json(['success' => $deleted], 200);
    }
    


    

    public function deletePageAccess(Request $request){        
        $access = Access::where('role_id',$request->role_id)
        ->where('page_id',$request->page_id)
        ->where('access_code',$request->access_code);
        
        $deleted = $access->delete();
            return Response::json(['success' => $deleted], 200);
    }
    
    

    public function getPages($roleId){
        $pages = $this->roleRepo->getPages($roleId);        
        return $pages;               
    }

    public function getUsers($roleId){
        $users = $this->roleRepo->getUsers($roleId);        
        return UserMappingResource::collection($users);               
    }

    public function getAvailablePage($roleId){        
        $pagesMapped = Access::where('role_id',$roleId)->groupBy('page_id')->pluck('page_id');
        $pagesAvailable = Page::whereNotIn('id',$pagesMapped)->get();        
        return $pagesAvailable;                
    }

    public function toggle(Request $request){        
        $saved = $this->roleRepo->toggle($request->id, $request->status);
        return Response::json(['success' => $saved], 200);
    }
    

}
