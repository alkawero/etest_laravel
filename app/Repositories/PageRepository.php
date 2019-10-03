<?php
namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageRepository{
    protected $user;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page->orderBy('navigation', 'asc');         
    }

    public function getLike($keyword)
    {
        $pages = Page::where('navigation', 'like', '%'.$keyword.'%')->get();
        return $pages;
    }

    public function toggle($id,$status){        
        $saved = Page::where('id', $id)
            ->update([
            'status' => $status
            ]);
            return $saved;
    }

    public function getById($id){
        return Page::find($id);                    
    }

    public function delete($id){
        $deleted = Page::destroy($id);                  
        return $deleted;            
    }

    public function update($request){        
        $saved = DB::table('pages')
            ->where('id', $request->id)
            ->update(['navigation' => $request->navigation,
            'path' => $request->path,
            'tittle' => $request->tittle,
            'status' => $request->status,
            'icon'=>$request->icon
            ]);

        return $saved;
        
    }

    public function create($request){        
        $page = new Page();
        $page->navigation = $request->navigation;
        $page->path = $request->path;
        $page->tittle = $request->tittle;
        $page->status = $request->status;
        $page->icon = $request->icon;
        $saved = $page->save();
        return $saved;
        
    }
}
