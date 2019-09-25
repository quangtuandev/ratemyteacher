<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewTeacher extends BaseModel
{
    use SoftDeletes;
    const BLOCK = 0;
    const ACTIVE = 1;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'description',
        'status',
        'number_of_likes',
        'rating',
        'user_id',
        'teacher_id',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }

    public function getReviewer($userId){
         $findUser = $this->user()
         ->where('id',$userId)
         ->select('id','name','email','avatar')
         ->first();
         return $findUser;
    }
    
    public function getTeacherOfReview($teacherId){
        $findTeacher = $this->teacher()
        ->where('id',$teacherId)
        ->select('id','name','email')
        ->first();
        return $findTeacher;
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
