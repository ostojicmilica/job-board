<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class Job extends Model
{
    use Moderatable;

    protected $fillable = [
        'title',
        'description',
        'email',
    ];
}
