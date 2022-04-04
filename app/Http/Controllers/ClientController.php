<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewClientNotification;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function index()
    {
        return view('front.clients.index');
    }

    public function store(Request $request){

        $valdiation = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email:filter',
            'mobile'=> 'nullable',
            'Details' => 'required',
        ]);
        if($valdiation->fails()) {
            return response()->json(['code' => '400', 'msg' => $valdiation->errors()->first()]);
        }


        $user = Auth::user();
        $clientDiscount = Client::create($request->all());
        // Send Notifiaction
        $user->notify(new NewClientNotification($clientDiscount));
        // If i want to send mail to all users or admin do as below
        $admins = User::all();

        return response()->json(['code' => 200, 'msg' => 'Thanks for contacting us, we will get back to you soon.']);

    }
}
