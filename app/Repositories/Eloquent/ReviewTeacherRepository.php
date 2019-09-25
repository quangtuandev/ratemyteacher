<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Models\ReviewTeacher;
use App\Exceptions\Api\UnknowException;
use App\Repositories\contracts\ReviewTeacherInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

class ReviewTeacherRepository extends BaseRepository implements ReviewTeacherInterface
{
    public function model(){
        return ReviewTeacher::class;
    }

    public function getReview($review){
        
        $info['user'] = $review->getReviewer($review['user_id']);
        $info['teacher'] = $review->getTeacherOfReview($review['teacher_id']);
        return
        [
            'review'=>$review,
            'info_review'=>$info
        ];
    }

    public function getLastest(){
        $reviews = $this->orderBy('created_at', 'desc')->take(10)->get();
        foreach ($reviews as $review) {
            $listReview[] = $this->getReview($review);
        }
       
        return [
            'reviews' => $listReview
        ];
       
    }
    public function getReviewByUser($userId){
        $reviews = $this->model->where('user_id', $userId)
        ->paginate(config('settings.paginate_review'));
        $data=$reviews->items();
        foreach ($data as $review) {
            $review->teacher = $review->getTeacherOfReview($review['teacher_id']);
        }
        return $reviews;
    }

    public function createReviewTeacher($data)
    {
        if (is_null($data) || !is_array($data)) {
            throw new UnknowException('Inputs is null or not an array');
        }
        $inputs = [
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => ReviewTeacher::BLOCK,
            'number_of_likes' => 0,
            'rating' => $data['rating'],
            'user_id' => Auth::user()->id,
            'teacher_id' => $data['teacher_id'],
        ];

        $review = parent::create($inputs);

        if (!$review) {
            throw new NotFoundException('Error create review');
        }

        return [
            'messenger' =>"You have created review teacher successfully.",
            'id' => $review->id
        ];
    }

    public function editReviewTeacher($data)
    {
        if (is_null($data) || !is_array($data)) {
            throw new UnknowException('Inputs is null or not an array');
        }

        parent::update($data['id'], $data);

        return [
            'messenger' =>"You have updated review teacher successfully."
        ];
    }
}
