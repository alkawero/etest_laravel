<?php

namespace App\Repositories;

use App\Models\Note;
use App\Models\Option;
use Symfony\Component\HttpFoundation\Request;

class NoteRepository {

    protected $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function getByParams($params)
    {
        //DB::enableQueryLog(); // Enable query log
        $query =  $this->note
        ->when($params->note_type_codes, function ($query) use ($params) {
            return $query->whereIn('note_type_code',$params->note_type_codes);
        })
        ->when($params->text, function ($query) use ($params) {
            return $query->where('text','like','%'.$params->text.'%');
        })
        ->when($params->tittle, function ($query) use ($params) {
            return $query->where('tittle','like','%'.$params->tittle.'%');
        })
        ->where(function($query) use ($params){
                return $query
                ->where('from',$params->user_id)
                ->orWhere('to_person',$params->user_id)
                ->orWhere('to_role',$params->to_role);
        })
        ->when($params->object_id, function ($query) use ($params) {
            return $query->where('object_id',$params->object_id);
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


    public function create(Request $request){
        $note = new Note();
        $note->note_type_code = $request->note_type_code;
        $note->text = $request->text;
        $note->tittle = $request->tittle;
        $note->from = $request->from;
        $note->to_person = $request->to_person;
        $note->to_role = $request->to_role;
        $note->represent_role = $request->represent_role;
        $note->object_id = $request->object_id;
        $note->status = $request->status;

        return $note->save();


    }



}
