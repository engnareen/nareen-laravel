<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequestFeature;

use Illuminate\Support\Facades\File;

class FeaturesController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('id' , 'desc')->get();

        return view('features.index', [
            'features' => $features
        ]);
    }

    public function createFeature()
    {
        return view('features.create',[
            'feature' => new Feature ,
        ]);
    }

    public function storeFeature(ValidationRequestFeature $request)
    {
        //dd($request->all());
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['description'] = $request->input('description');

        $image = $request->file('image_path');

        if($image){
        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Features'), $file_name);

        $input['image_path'] =$file_name;

        }

        Feature::create($input)->save();
         return redirect()->route('feature.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editFeature(Feature $feature){
        return view('features.edit' , [
            'feature' => $feature ,
        ]);
    }
    public function updateFeature(ValidationRequestFeature $request, Feature $feature){
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['description'] = $request->input('description');

        $image = $request->file('image_path');
        if($image){
            if($feature->image_path !=null && File::exists('uploads/Features/' . $feature->image_path)){
                unlink('uploads/Features/' . $feature->image_path);

            }

        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Features'), $file_name);

        $input['image_path'] =$file_name;
        }
        $feature->update($input);
        return redirect()->route('feature.index')
        ->with([
            'message' => 'Feature updated successfully',
            'alert-type' => 'info'
        ]);
    }
    public function destroyFeature($id){
        $feature = Feature::find($id);

        if($feature->image_path !=null && File::exists('uploads/Features/' . $feature->image_path)){
            unlink('uploads/Features/' . $feature->image_path);
        }
        $feature->delete();
        return redirect('admin/features')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);
    }
    // Remove Image
    public function remove_image(Request $request)
    {
        $feature = Feature::findOrFail($request->feature_id);
        if (File::exists('uploads/Features/'. $feature->image_path)){
            unlink('uploads/Features/'. $feature->image_path);
            $feature->image_path = null;
            $feature->save();
        }
        return true;
    }

}
