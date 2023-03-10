<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserIndex extends Component
{
    public function render()
    {
        $users = User::all();
        return view('livewire.user-index',compact('users'));
    }
}
