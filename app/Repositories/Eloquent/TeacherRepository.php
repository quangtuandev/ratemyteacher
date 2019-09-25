<?php

namespace App\Repositories\Eloquent;

use Auth;
use Exception;
use App\Models\Teacher;
use App\Models\Media;
use App\Repositories\Contracts\TeacherInterface;
use App\Exceptions\Api\UnknowException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherRepository extends BaseRepository implements TeacherInterface
{

    public function model()
    {
        return Teacher::class;
    }

    public function getTeacher($teacher){
        $teacher['user'] = $teacher->getUserCreatedTeacher($teacher['user_id']);
        $teacher['media'] = $teacher->media()->pluck('url');
        return[
            'teacher' => $teacher
        ];
    }
    public function getReviewTeacher($teacher){
        $teacher['review'] = $teacher->reviews()
        ->where('teacher_id',$teacher['id'])
        ->orderBy('created_at', 'desc')
        ->paginate(config('settings.paginate_review'));
        $data=$teacher['review']->items();
        foreach ($data as $review) {
            $review->user = $review->getReviewer($review['user_id']);
        }

        return[
            'review' => $teacher['review']
        ];
    }
    public function create($inputs){
        // dd($inputs['user_id']);
        if (is_null($inputs) || !is_array($inputs)) {
            throw new UnknowException('Inputs is null or not an array');
        }
        $data = [
            'name' => $inputs['name'],
            'birthday' => $inputs['birthday'],
            'gender' => $inputs['gender'],
            'address' => $inputs['address'],
            'specialize' => $inputs['specialize'],
            'description' => empty($inputs['description']) ? null : $inputs['description'],
            'phone' => empty($inputs['phone']) ? null : $inputs['phone'],
            'image' => empty($inputs['image']) ? config('settings.default_avatar') : $inputs['image'],
            'identity_card' => empty($inputs['identity_card']) ? null : $inputs['identity_card'],
            'email' => empty($inputs['email']) ? null : $inputs['email'],
            'user_id' =>  $inputs['user_id'],
        ];
        $teacher = parent::create($data);

        if (!$teacher) {
            throw new NotFoundException('Error create teacher');
        }
        return "You have created teacher successfully.";
    }

    public function searchTeacher($keyword)
    {
        $this->setGuard('api');
        $resutTeacher = $this->search($keyword)
        // ->where('status', USER::ACTIVE)
        ->groupBy('created_at')
        ->orderBy('created_at', 'DESC')
        ->select(array('id','name','email','specialize','image'))
        ->get();
        // $data = $resutTeacher->items();
        foreach ($resutTeacher as $teacher) {
            $teacher['overView'] = $this->getOverView($teacher);
        }
        return [
            'teachers' => $resutTeacher,
            'totalTeacher' => $resutTeacher->count(),
        ];
    }

    public function getOverView($teacher){
        $reviews = $teacher->reviews()
        ->where('teacher_id',$teacher['id'])
        ->get();
        $info['count']  = $reviews->count();
        $info['avg'] = $reviews->avg('rating');
        $info['star'] = round($reviews->avg('rating'));
        return $info;
    }
}
