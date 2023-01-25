<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculam;

class Course extends Model
{
    use HasFactory;

    public function curriculams(){
        return $this->hasMany(Curriculam::class);
    }
}
