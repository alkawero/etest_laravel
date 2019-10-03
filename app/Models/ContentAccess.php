<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContentAccess extends Pivot
{
    protected $connection = 'etest_cbt';
    protected $table = 'content_access';
}
