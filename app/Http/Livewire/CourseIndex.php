<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseIndex extends Component
{
    public function render()
    {
        $course = Course::paginate(10);

        return view('livewire.course-index', [
            'courses' => $course,
        ]);
    }
}
