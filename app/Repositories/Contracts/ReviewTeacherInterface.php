<?php
namespace App\Repositories\Contracts;

interface ReviewTeacherInterface extends RepositoryInterface
{
    public function getReview($review);

    public function getLastest();

    public function getReviewByUser($userId);

    public function createReviewTeacher($data);

    public function editReviewTeacher($data);
}