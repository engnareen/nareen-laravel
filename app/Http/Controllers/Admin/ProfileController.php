<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        //return $user->profile->birthday->format('d/m/Y');
        return view('profile.edit',[
            'user' => $user,
            'profile' => $user->profile,
            'gender' => [
                'male' => 'Male',
                'female' => 'Female',

                ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {            //dd($request->all());
        $request->validate([
            'first_name' => ['required'],
            'profile_photo' => [
                'nullable',
                'mimes:jpg,jpeg',
                'dimensions:min-height=200,min-width=200'
                ],
            'email' => ['required', 'email'],
            'birthday' => ['date_format:Y-m-d']
        ]);

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['description'] = $request->description;
        $input['gender'] = $request->gender;
        $input['job_title'] = $request->job_title;
        $input['country'] = $request->country;
        $input['birthday'] = $request->birthday;

        $user = Auth::user();
        $image = $request->file('profile_photo');

        if($image){
            if($profile->profile_photo !=null && File::exists('/images/profile_photos/' . $profile->profile_photo)){
                unlink('/images/profile_photos/' . $profile->profile_photo);
            }
            $file_name = time() . '-' . $request->first_name . '.' . $image->extension();
            $image->move(public_path('/images/profile_photos'), $file_name);

            $input['profile_photo'] = $file_name;
        //     $request->merge([
        //     'profile_photo' => $file_name,
        // ]);
        }
        $user->profile()->updateOrCreate([
            'user_id' => $user->id,
        ], $input);

        //Session::flash('success', 'profile updated succesfully');
        return redirect()->route('profile.edit')->with([
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
