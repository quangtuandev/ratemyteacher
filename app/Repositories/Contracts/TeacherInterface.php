<?php

namespace App\Repositories\Contracts;

interface TeacherInterface extends RepositoryInterface
{
    public function getTeacher($teacher);

    public function getReviewTeacher($teacher);

    public function create($inputs);

    public function searchTeacher($keyword);
    
    public function getOverView($teacher);
}
