<?php

namespace App\Http\Resources;

use App\Models\ExamStudentParticipant;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


     protected  $roleRepo;
     protected  $student;
    public function __construct(ExamStudentParticipant $student,RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->student = $student;

    }

    public function toArray($request)
    {

        $role = $this->roleRepo->getById(1);
        $pgs = $this->roleRepo->getPages(1);
        return [
            'id' => $this->student->nis,
            'name' => $this->student->exam_account_num,
            'status'=>$this->student->status,
            'roles' => [$role],
            'pages' => $pgs
        ];
    }
}
