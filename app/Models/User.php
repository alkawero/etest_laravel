<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection   = 'hris';
    protected $table        = 'msemployee';
    protected $primaryKey   = 'emp_id';
    protected $keyType      = 'string';
    public    $incrementing =  false;

    public function roles(){
        return $this->belongsToMany('App\Models\Role', 'etest_cbt_db.user_role', 'user_id','role_id');
    }
}
