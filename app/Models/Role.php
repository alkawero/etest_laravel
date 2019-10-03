<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection   = 'etest_cbt';
    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'access', 'role_id','page_id')->groupBy('pages.id');
    }
    public function pagesAccess()
    {
        return $this->belongsToMany('App\Models\Page', 'access', 'role_id','page_id')->withPivot('access_code');
    }
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'etest_cbt_db.user_role', 'role_id','user_id')->select('emp_id','emp_name');
    }
    
}
