<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RancanganReviewer extends Pivot
{
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'user_id','emp_id');

    }

    public function rancangan()
    {
        return $this->belongsTo('App\Models\Rancangan', 'rancangan_id','id');

    }
}
