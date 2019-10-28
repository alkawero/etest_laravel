<?php

namespace App\Repositories;

use App\Models\Option;
use App\Models\Soal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class SoalRepository {

    protected $soal;

    public function __construct(Soal $soal)
    {
        $this->soal = $soal;
    }

    public function getByParams($params)
    {
        //DB::enableQueryLog(); // Enable query log
        $query =  $this->soal
        ->when($params->user_id, function ($query) use ($params) {
            return $query->where('create_by',$params->user_id);
        })
        ->when($params->jenjang, function ($query) use ($params) {
            return $query->where('jenjang',$params->jenjang);
        })
        ->when($params->grade_num, function ($query) use ($params) {
            return $query->where('grade_num',$params->grade_num);
        })
        ->when($params->grade_char, function ($query) use ($params) {
            return $query->where('grade_char',$params->grade_char);
        })
        ->when($params->subject, function ($query) use ($params) {
            return $query->where('subject',$params->subject);
        })
        ->when($params->external, function ($query) use ($params) {
            return $query->where('external',$params->external);
        })
        ->when($params->answer_type, function ($query) use ($params) {
            return $query->where('answer_type',$params->answer_type);
        })
        ->when($params->source, function ($query) use ($params) {
            return $query->where('source','like',"'%'".$params->source."'%'");
        })
        ->when($params->creator, function ($query) use ($params) {
            return $query->where('create_by',$params->creator);
        })
        ->when($params->updater, function ($query) use ($params) {
            return $query->where('update_by',$params->updater);
        })
        ->when($params->active, function ($query) use ($params) {
            return $query->where('active',$params->active);
        })
        ->when($params->status, function ($query) use ($params) {
            return $query->where('status',$params->status);
        })
        ;
        //$result = $query->get();
        //return $result;
        //$soal = \App\Models\Soal::hydrate($result);
        return $query;
        //dd(DB::getQueryLog());
    }

    public function getSoal()
    {
        return $this->soal;
    }

    public function create(Request $request){
        $soal = new Soal();
        $soal->external = $request->external;
        $soal->create_by = $request->create_by;
        $soal->answer_type = $request->answer_type;
        $soal->content_type = $request->content_type;
        $soal->question_type = $request->question_type;
        $soal->active = $request->active;
        $soal->status = $request->status;
        $soal->content = $request->content;
        $soal->question = $request->question;
        $soal->right_answer = $request->right_answer;
        $soal->media_url = $request->media_url;
        $soal->level = $request->level;
        $soal->subject = $request->subject;
        $soal->grade_char = $request->grade_char;
        $soal->grade_num = $request->grade_num;
        $soal->jenjang = $request->jenjang;
        $soal->source = $request->source;
        $kds        = $request->kds;
        $indicators = $request->indicators;
        $ranahs     = $request->ranahs;

        $soal->save();
        $soal->kds()->attach($kds);
        $soal->indicators()->attach($indicators);
        $soal->ranahs()->attach($ranahs);

        if($soal->answer_type==='M'){
            foreach ($request->options as $option) {
                $opt = new Option();
                $opt->content_type = $option['contentType'];
                $opt->content     = $option['content']   ;
                $opt->code =        $option['code'];
                $opt->soal_id =     $soal->id;
                $opt->save();
            }
        }

    }


    public function update(Request $request){
        $soal = Soal::find($request->id);
        $soal->external = $request->external;
        $soal->create_by = $request->create_by;
        $soal->answer_type = $request->answer_type;
        $soal->content_type = $request->content_type;
        $soal->question_type = $request->question_type;
        $soal->active = $request->active;
        $soal->status = $request->status;
        $soal->content = $request->content;
        $soal->question = $request->question;
        $soal->right_answer = $request->right_answer;
        $soal->media_url = $request->media_url;
        $soal->level = $request->level;
        $soal->subject = $request->subject;
        $soal->grade_char = $request->grade_char;
        $soal->grade_num = $request->grade_num;
        $soal->jenjang = $request->jenjang;
        $soal->source = $request->source;
        $kds        = $request->kds;
        $indicators = $request->indicators;
        $ranahs     = $request->ranahs;
        $soal->kds()->sync($kds);
        $soal->indicators()->sync($indicators);
        $soal->ranahs()->sync($ranahs);



        if($soal->answer_type==='M'){
            Option::where('soal_id',$soal->id)->delete();
            foreach ($request->options as $option) {
                $opt = new Option();
                $opt->content_type = $option['contentType'];
                $opt->content     = $option['content']   ;
                $opt->code =        $option['code'];
                $opt->soal_id =     $soal->id;
                $opt->save();
            }
        }
        $soal->save();

    }

    public function delete($id){
        DB::table('options')->where('soal_id', $id)->delete();
        $deleted = Soal::destroy($id);
        return $deleted;
    }

    public function toggle($id,$active){
        $saved = Soal::where('id', $id)
            ->update([
            'active' => $active
            ]);
            return $saved;
    }



    public function getById($id){
        return Soal::find($id);
    }

    public function saveImageOption($request){
        $file = $request->file('file');
        $destination = 'public/imgs';
        $path = $file->store($destination);
        $url = 'http://'.$request->getHttpHost().Storage::url($path);

        $soal_id = $request->soal_id;
        if($soal_id){
            $content_type = 4;
            $code = $request->code;
            $content = $url;

            DB::table('options')->insert(
                ['soal_id' => $soal_id,
                'code' => $code,
                'content' => $content,
                'content_type' => $content_type]
            );
        }
        return ['url'=>$url,
                'link'=>$url];
    }
}
