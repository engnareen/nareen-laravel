<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
public function index(){
    return view('team.index');
}

public function save(Request $request){

    $validator = \Validator::make($request->all(),[
        'name'=>'required|string',
        'image'=>'required|image'
    ],[
        'name.required'=>'name is required',
        'name.string'=>'name must be a string',
        'image.required'=>'member image is required',
        'image.image'=>'member file must be an image',
    ]);

    if(!$validator->passes()){
        return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
    }else{
        $path = 'teamMembers/';
        $file = $request->file('image');
        $file_name = time().'_'.$file->getClientOriginalName();

        //    $upload = $file->storeAs($path, $file_name);
        $upload = $file->storeAs($path, $file_name, 'public');

        if($upload){
            Team::insert([
                'name'=>$request->name,
                'job_description'=>$request->job_description,
                'image'=>$file_name,
            ]);
            return response()->json(['code'=>1,'msg'=>'New Member has been saved successfully']);
        }
    }
}

    public function fetchteams(){
        $teams = Team::all();
        $data = \View::make('team.all_teams')->with('teams', $teams)->render();
        return response()->json(['code'=>1,'result'=>$data]);
    }

    public function getTeamDetails(Request $request){
        $team = Team::find($request->id);
        return response()->json(['code'=>1,'result'=>$team]);

    }

    public function updateTeam(Request $request){
        //dd($request->all());
        $team_id = $request->t_id;
        $team= Team::find($team_id);
        $path = 'teamMembers/';

        // validator
        $validator = \Validator::make($request->all(), [
            'name'=>'required|string',
            'image'=>'image',
            'job_description' =>'required|string'
        ],[

            'image.image'=>'member file must be an image',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{

            if($request->hasFile('image')){
                $file_path = $path.$team->image;
                //delete old Image
                if($team->image !=null && \Storage::disk('public')->exists($file_path)){
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('image');
                $file_name = time().'_'.$file->getClientOriginalName();
                $upload = $file->storeAs($path, $file_name, 'public');

                if($upload){
                    $team->update([
                        'name'=> $request->name,
                        'job_description'=>$request->job_description,
                        'image' => $file_name
                    ]);
                    return response()->json(['code'=>1,'msg'=> 'A member has been updated successfully']);

                }
            }


            else{
                $team->update([
                    'name'=> $request->name,
                    'job_description'=>$request->job_description,
                ]);
                return response()->json(['code'=>1,'msg'=> 'A member is updated successfully']);
            }
        }
    }

    public function deleteMember(Request $request){
        $team = Team::find($request->id);
        $path = 'teamMembers/';
        $file_path = $path.$team->image;

        if($team->image !=null && \Storage::disk('public')->exists($file_path)){
            \Storage::disk('public')->delete($file_path);
        }
        $query = $team->delete();
        if($query){
            return response()->json(['code'=>1,'msg'=> 'A member has been deleted successfully']);

        }
        else{
            return response()->json(['code'=>0,'msg'=> 'Some thing went Wrong']);

        }

    }
}
