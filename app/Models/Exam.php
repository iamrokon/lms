<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Homework;

class Exam extends Model
{
    use HasFactory;

    public function homeworks(){
        $this->hasMany(Homework::class);
    }
}
