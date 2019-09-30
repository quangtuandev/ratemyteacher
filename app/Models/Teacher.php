<?php

namespace App\Models;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @SWG\Definition()
 */
class Teacher extends BaseModel
{
    use SoftDeletes,SearchableTrait;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'description',
        'birthday',
        'gender',
        'address',
        'phone',
        'specialize',
        'image',
        'identity_card',
        'email',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    protected $searchable = [
        'columns' => [
            'teachers.name' => 9,
            'teachers.email' => 10,
        ],
    ];

    public function reviews()
    {
        return $this->hasMany('App\Models\ReviewTeacher');
    }

    public function getReviewOfTeacher($teacherId)
    {
        return $this->reviews()->where('teacher_id',$teacherId)->paginate(config('settings.paginate_review'));
    }

    public function getReview($teacherId){

        dd($this->reviews()->where('teacher_id',$teacherId)->get());
        return 0;
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function getUserCreatedTeacher($teacherId)
    {
        $findUser =  $this->user()
        ->where('id',$teacherId)
        ->select('id','name','email','avatar')
        ->first();
        return $findUser;
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
    public function centers()
    {
        return $this->belongsToMany(Center::class)->withTimestamps();
    }
}
