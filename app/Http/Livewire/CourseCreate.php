<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseCreate extends Component
{
    public $name;
    public $description;
    public $price;
    public $selectedDays = [];

    public $days = [
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
    ];

    protected $rules = [
        // 'name' => 'required',
        'name' => 'required|unique:courses,name',
        'description' => 'required',
        'price' => 'required',
    ];

    public function formSubmit() {
        $this->validate();
        $course = Course::create([
            'name' => $this->name,
            'slug' => str_replace(' ', '-', $this->name),
            'description' => $this->description,
            'price' => $this->price,
            'user_id' => auth()->user()->id,
        ]);

        // check how many sunday available
        $i = 1;
        $start_date = new DateTime(Carbon::now());
        $endDate =   new DateTime($this->end_date);
        $interval =  new DateInterval('P1D');
        $date_range = new DatePeriod($start_date, $interval, $endDate);
        foreach ($date_range as $date) {
            foreach ($this->selectedDays as $day) {
                if ($date->format("l") === $day) {
                    Curriculum::create([
                        'name' => $this->name . ' #' . $i++,
                        'week_day' => $day,
                        'class_time' => $this->time,
                        'end_date' => $this->end_date,
                        'course_id' => $course->id,
                    ]);
                }
            }
        }
        $i++;

        flash()->addSuccess('Course created successfully');
        return redirect()->route('course.index');
    }

    public function render()
    {
        return view('livewire.course-create');
    }
}
