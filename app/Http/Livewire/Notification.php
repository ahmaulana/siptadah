<?php

namespace App\Http\Livewire;

use App\Models\Notification as ModelsNotification;
use Livewire\Component;


class Notification extends Component
{
    public $total;
    public $notifications;

    public function mount()
    {
        $this->notifications = ModelsNotification::take(5)->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $this->total = ModelsNotification::take(5)->where('user_id', auth()->user()->id)->where('status', false)->count();
    }

    public function render()
    {
        $notifications = $this->notifications;
        $total = $this->total;
        return view('livewire.notification', compact(['notifications', 'total']));
    }

    public function notificationClick()
    {
        ModelsNotification::where('status', false)->update([
            'status' => true,
        ]);        
        $this->total = 0;
    }
}
