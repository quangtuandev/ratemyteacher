<?php

namespace App\Repositories\Eloquent;

use App\Models\Center;
use App\Repositories\Contracts\CenterInterface;

class CenterRepository extends BaseRepository implements CenterInterface
{
    public function model()
    {
        return Center::class;
    }

}
