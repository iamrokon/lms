<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Homework;
use App\Models\Attendance;

class Curriculam extends Model
{
    use HasFactory;

    public function homeworks(){
        $this->hasMany(Homework::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    // public function notes(){
    //     return $this->hasMany(Note::class);
    // }
}
