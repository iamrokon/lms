<?php

namespace App\Http\Livewire;

use App\Models\Curriculam;
use Livewire\Component;

class CurriculamEdit extends Component
{
    public $curriculam_id;
    public $name;
    public function mount(){
        $curriculam = Curriculam::findOrFail($this->curriculam_id);

        $this->name = $curriculam->name;
    }
    protected $rules = [
        'name' => 'required',
    ];
    public function render()
    {
        return view('livewire.curriculam-edit');
    }

    public function curriculamUpdate(){
        $this->validate();
        $curriculam = Curriculam::findOrFail($this->curriculam_id);

        $curriculam->name = $this->name;
        $curriculam->save();

        flash()->addSuccess('Curriculam updated successfully');

    }
}
