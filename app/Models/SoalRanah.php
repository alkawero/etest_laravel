<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SoalRanah extends Pivot
{
    protected $connection   = 'etest_cbt';
    protected $table        = 'soal_ranah';
}
