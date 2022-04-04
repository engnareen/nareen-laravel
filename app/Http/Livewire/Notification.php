<?php

namespace App\Http\Livewire;

use App\Models\Toster;
use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        return view('livewire.notification');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'User Created Successfully!']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertError()
    {
        $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Something is Wrong!']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertInfo()
    {
        $this->dispatchBrowserEvent('alert',
                ['type' => 'info',  'message' => 'Going Well!']);
    }
    public function tosterPost(){

        //$this->validate();
        Toster::craete([
            'name' => $this->name,
        ]);

        $this->dispatchBrowserEvent('toastr:info', [
            'message' => 'Success',
        ]);
        $this->name = '';

    }
}

