<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Homework;
use App\Models\Attendance;
use App\Models\Note;
use App\Models\Course;

class Curriculam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'week_day',
        'class_time',
        'end_date',
        'course_id'
    ];

    public function homeworks(){
        return $this->hasMany(Homework::class);
    }
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function notes(){
        // return $this->belongsToMany(Note::class, 'curriculam_note', 'curriculam_id', 'note_id');
        return $this->belongsToMany(Note::class, 'curriculam_note');
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function presentStudents() {
        return Attendance::where('curriculam_id', $this->id)->count();
    }
}
