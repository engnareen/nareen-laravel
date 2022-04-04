<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    public function index(){
        $gallaries = Gallary::all();
    return view('gallary.index', ['gallaries' => $gallaries ]);
    }

    public function saveGallary(Request $request){

        $validator = \Validator::make($request->all(),[
            'details'=>'required',
            'image'=>'required|image'
        ],[
            'details.required'=>'details is required',
            'image.required'=>'member image is required',
            'image.image'=>'member file must be an image',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $path = 'Gallary/';
            $file = $request->file('image');
            $file_name = time().'_'.$file->getClientOriginalName();

            //    $upload = $file->storeAs($path, $file_name);
            $upload = $file->storeAs($path, $file_name, 'public');

            if($upload){
                Gallary::insert([
                    'details'=>$request->details,
                    'image'=>$file_name,
                ]);
                return response()->json(['code'=>1,'msg'=>'New photo has been saved successfully']);
            }
        }
    }

        public function fetchGallary(){
            $gallaries = Gallary::all();
            $data = \View::make('gallary.all_gallary')->with('gallaries', $gallaries)->render();
            return response()->json(['code'=>1,'result'=>$data]);
        }

        public function getGallaryDetails(Request $request){
            $gallary = Gallary::find($request->id);
            return response()->json(['code'=>1,'result'=>$gallary]);

        }

        public function updateGallary(Request $request){
            //dd($request->all());
            $gallary_id = $request->t_id;
            $gallary= Gallary::find($gallary_id);
            $path = 'Gallary/';

            // validator
            $validator = \Validator::make($request->all(), [
                'details'=>'required',
                'image'=>'image',
            ],[

                'image.image'=>'gallary file must be an image',
            ]);

            if(!$validator->passes()){
                return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
            }else{

                if($request->hasFile('image')){
                    $file_path = $path.$gallary->image;
                    //delete old Image
                    if($gallary->image !=null && \Storage::disk('public')->exists($file_path)){
                        \Storage::disk('public')->delete($file_path);
                    }
                    $file = $request->file('image');
                    $file_name = time().'_'.$file->getClientOriginalName();
                    $upload = $file->storeAs($path, $file_name, 'public');

                    if($upload){
                        $gallary->update([
                            'details'=> $request->details,
                            'image' => $file_name
                        ]);
                        return response()->json(['code'=>1,'msg'=> 'A photo has been updated successfully']);

                    }
                }


                else{
                    $gallary->update([
                        'details'=> $request->details,
                    ]);
                    return response()->json(['code'=>1,'msg'=> 'A photo is updated successfully']);
                }
            }
        }

        public function deleteGallary(Request $request){
            $gallary = Gallary::find($request->id);
            $path = 'Gallary/';
            $file_path = $path.$gallary->image;

            if($gallary->image !=null && \Storage::disk('public')->exists($file_path)){
                \Storage::disk('public')->delete($file_path);
            }
            $query = $gallary->delete();
            if($query){
                return response()->json(['code'=>1,'msg'=> 'A photo has been deleted successfully']);

            }
            else{
                return response()->json(['code'=>0,'msg'=> 'Some thing went Wrong']);

            }

        }
    }
