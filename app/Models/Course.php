<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculam;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    public function curriculams(){
        return $this->hasMany(Curriculam::class);
    }

    public function students(){
        return $this->belongsToMany(User::class, 'course_student', 'course_id', 'user_id');
    }

}
