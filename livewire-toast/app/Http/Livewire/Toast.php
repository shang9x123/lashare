<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Toast extends Component
{
    use LivewireAlert;
    public function toast()
    {
        $this->alert('info', 'Thong bao!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'cac ban da demo thanh cong nhe',
        ]);
    }
    public function render()
    {
        return view('livewire.toast');
    }
}
