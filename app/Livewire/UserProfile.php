<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{   
    public $userId;
    public $user;
    
    protected $listeners = ['userUpdated' => 'refreshUser'];
    
    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::find($userId);
    }

    public function refreshUser()
    {
        $this->user = User::find($this->userId);
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
