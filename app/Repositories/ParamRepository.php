<?php
namespace App\Repositories;

use App\Models\Parameter;
use Illuminate\Support\Facades\DB;

class ParamRepository{
    protected $parameter;

    public function __construct(Parameter $parameter)
    {
        $this->parameter = $parameter;
    }


    
    public function create($request){        
        $newObj = new Parameter();
        $newObj->group = $request->group;
        $newObj->value = $request->value;
        $newObj->key = $request->key;
        $newObj->char_code = $request->charCode;
        $newObj->num_code = $request->numCode;
        $newObj->desc = $request->desc;
        $newObj->status = $request->status;
        $saved = $newObj->save();        
        
        return $saved;
        
    }   



    public function getByParams($params)
    {
        $query =  DB::table('parameters')
        ->when(isset($params['value']), function ($query) use ($params) {
            return $query->where('value','like','%'.$params['value'].'%');
        })
        ->when(isset($params['group']), function ($query) use ($params) {
            return $query->where('group',$params['group']);
        })
        ->when(isset($params['key']), function ($query) use ($params) {
            return $query->where('key',$params['key']);
        })
        ->when(isset($params['status']), function ($query) use ($params) {
            return $query->where('status',$params['status']);
        });                
        return $query;         
    }
    
    public function paginate($pageNum)
    {
        return $this->parameter->paginate($pageNum);         
    }

    public function getGroups(){
        return Parameter::groupBy('group')->pluck('group');
    }

    public function getByGroup($group){
        return Parameter::where('group',$group)->get();
    }

    public function getLike($keyword)
    {
        $parameters = Parameter::where('navigation', 'like', '%'.$keyword.'%')->get();
        return $parameters;
    }

    public function toggle($id,$status){        
        $saved = Parameter::where('id', $id)
            ->update([
            'status' => $status
            ]);
            return $saved;
    }

    public function getById($id){
        return Parameter::find($id);                    
    }

    public function delete($id){
        $deleted = Parameter::destroy($id);                  
        return $deleted;            
    }

    public function update($request){        
        $saved = DB::table('parameters')
            ->where('id', $request->id)
            ->update(['group' => $request->group,
                    'value' => $request->value,
                    'key' => $request->key,
                    'char_code' => $request->charCode,
                    'num_code' => $request->numCode,
                    'desc'=>$request->desc,
                    'status'=>$request->status
            ]);

        return $saved;
        
    }
}
