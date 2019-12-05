<?php

namespace App\Repositories;

use App\Models\SubjectReviewer;
use Illuminate\Http\Request;

class SubjectReviewerRepository {

    protected $sr;

    public function __construct(SubjectReviewer $sr)
    {
        $this->sr = $sr;
    }

    public function getByParams($params)
    {
        $query =  $this->sr
        ->when($params->user_id, function ($query) use ($params) {
            return $query->where('user_id',$params->user_id);
        })
        ->when($params->subject_id, function ($query) use ($params) {
            return $query->where('subject_id',$params->subject_id);
        })
        ->when($params->jenjang, function ($query) use ($params) {
            return $query->where('jenjang',$params->jenjang);
        })
        ;
        return $query;
    }

    public function getByUserId($user_id)
    {
        return $this->sr->where('user_id',$user_id);
    }

    public function create(Request $request)
    {
        $sr = new SubjectReviewer();
        $sr->user_id = $request->user_id;
        $sr->subject_id = $request->subject_id;
        $sr->jenjang = $request->jenjang;
        $sr->save();

    }

    public function update(Request $request)
    {
        $sr = SubjectReviewer::find($request->id);
        $sr->user_id = $request->user_id;
        $sr->subject_id = $request->subject_id;
        $sr->jenjang = $request->jenjang;
        $sr->save();

    }
    public function delete($id)
    {
        $deleted = SubjectReviewer::destroy($id);
        return $deleted;
    }


    }
