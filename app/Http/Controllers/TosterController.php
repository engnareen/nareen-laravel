<?php

namespace App\Http\Controllers;

use App\Models\Toster;
use Illuminate\Http\Request;

class TosterController extends Controller
{
    public function index(){
        return view('toster.index');
    }

    public function store(){

        Toster::craete([
            'name' => 'name',
        ]);

        $this->dispatchBrowserEvent('toastr:info', [
            'message' => 'Success',
        ]);
        $this->title = '';

    }
}
