<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Exceptions\Api\UnknowException;
use App\Http\Requests\ReviewTeacherRequest;
use App\Repositories\Contracts\ReviewTeacherInterface;


class ReviewTeacherController extends ApiController
{
    protected $reviewTeacherRepository;

    public function __construct(
        ReviewTeacherInterface $reviewTeacherRepository
    ) {
        parent::__construct();
        $this->reviewTeacherRepository = $reviewTeacherRepository;
    }

    public function show($id)
    {
        $review = $this->reviewTeacherRepository->findOrFail($id);
        return $this->getData(function () use ($review) {
            $this->compacts['detail_review'] = $this->reviewTeacherRepository->getReview($review);
        });
    }
    
    public function getLastest()
    {
        return $this->getData(function (){
           $this->compacts['review_lastest'] = $this->reviewTeacherRepository->getLastest(); 
        });
    }

    public function createReviewTeacher(ReviewTeacherRequest $request)
    {
        $data =$request->only(
            'name',
            'description',
            'rating',
            'teacher_id'
        );
        return $this->doAction(function () use($data){
            $this->compacts['review'] = $this->reviewTeacherRepository->createReviewTeacher($data);
        });
    }

    public function deleteReviewTeacher($id)
    {
        $review = $this->reviewTeacherRepository->findOrFail($id);

        if ($this->user->cant('delete', $review)) {
            throw new UnknowException("Permission error: User can not delete this action.");
        }

        return $this->doAction(function () use ($review) {
            $this->compacts['reivew'] = $review->delete();
        });
    }

    public function edit(ReviewTeacherRequest $request)
    {
        $data =$request->only(
            'id',
            'name',
            'description',
            'rating'
        );

        $review = $this->reviewTeacherRepository->findOrFail($data['id']);

        if ($this->user->cant('update', $review)) {
            throw new UnknowException("Permission error: User can not edit this review.");
        }

        return $this->doAction(function () use($data){
            $this->compacts['review'] = $this->reviewTeacherRepository->editReviewTeacher($data);
        });
    }
}
