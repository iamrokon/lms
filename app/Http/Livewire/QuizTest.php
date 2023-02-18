<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuizTest extends Component
{
    public $quiz;
    public $answer;
    public $answered = [];

    public function render()
    {
        return view('livewire.quiz-test');
    }
    public function check(){
        $question_id = explode('-', $this->answer)[1];
        $question = Question::findOrFail($question_id);

        if($question->correct_answer == explode('-', $this->answer)[0]){
            flash()->addSuccess('Correct answer');
            $correct = true;
        }else{
            flash()->addError('Wrong answer');
            $correct = false;
        }
        $this->answered[$question->id] = $correct;
    }
}
