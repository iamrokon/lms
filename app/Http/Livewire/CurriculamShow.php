<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use App\Models\Curriculam;
use App\Models\Note;
use Livewire\Component;

class CurriculamShow extends Component
{
    public $curriculam_id;
    public $note;

    protected $rules = [
        'note' => 'required',
    ];
    public function render()
    {
        $curriculam = Curriculam::findOrFail($this->curriculam_id);

        return view('livewire.curriculam-show',[
            'curriculam' => $curriculam,
            'notes' => $curriculam->notes,
        ]);
    }

    public function addNote(){
         $this->validate();
          $curriculam = Curriculam::findOrFail($this->curriculam_id);
          $note = new Note();
          $note->description = $this->note;
          $note->save();

          $curriculam->notes()->attach($note->id);

          $this->note = '';

          flash()->addSuccess('Note added successfully!');
    }

    public function attendance($student_id) {
        Attendance::create([
            'curriculam_id' => $this->curriculam_id,
            'user_id' => $student_id
        ]);

        flash()->addSuccess('Attendance added successfully!');
    }
}
