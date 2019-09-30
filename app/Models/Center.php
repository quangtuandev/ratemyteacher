<?php

namespace App\Models;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @SWG\Definition()
 */
class Center extends BaseModel
{
    use SoftDeletes,SearchableTrait;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'website',
        'image',
        'email',
    ];

    protected $dates = ['deleted_at'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

}
