<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Curriculam;

class CourseShow extends Component
{
    public $course_id;
    public function render()
    {
        $course = Course::where('id', $this->course_id)->first();
        $curriculams = Curriculam::where('course_id', $this->course_id)->get();

        return view('livewire.course-show', [
            'course' => $course,
            'curriculams' => $curriculams,
        ]);
    }

    public function curriculamDelete($id)
    {
        $curriculam = Curriculam::findOrFail($id);

        $curriculam->delete();

        flash()->addSuccess('Curriculam deleted successfully');
    }
}
