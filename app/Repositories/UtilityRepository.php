<?php
namespace App\Repositories;

use App\Models\MathFormula;
use Illuminate\Support\Facades\DB;

class UtilityRepository{
    protected $math;
    public function __construct(MathFormula $math)
    {
        $this->math = $math;
    }

    public function getMathFormula(){
        return $this->math;
    }


    public function updateMathFormula($request){
        $saved = DB::table('math_formulas')
            ->where('id', $request->id)
            ->update(['html_symbol' => $request->html_symbol,
            'asciimath' => $request->asciimath,
            'latex' => $request->latex,
            ]);

        return $saved;

    }

    public function createMathFormula($request){
        $math = new MathFormula();
        $math->html_symbol = $request->html_symbol;
        $math->asciimath = $request->asciimath;
        $math->latex = $request->latex;
        $saved = $math->save();
        return $saved;

    }


}
