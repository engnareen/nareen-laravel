<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValditionReqestPlan;
use App\Models\Plan;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlansController extends Controller
{
    public function index(){
        $plans = Plan::get();
        return view('plans.index',[
            'plans' => $plans,
        ]);
    }

    public function createPlan(){
        $tags = Tag::whereStatus(1)->get(['id', 'name']);
        return view('plans.create',compact('tags'),[
            'plan' => new Plan,
            'name' => [
                'Basic' => 'Basic',
                'Advanced' => 'Advanced',
                'Professional' => 'Professional',
                'Golden' => 'Golden',

            ],
            'type' => [
                'Per Month' => 'Per Month',
                'Per Year' => 'Per Year',

            ],
        ]);
    }

    public function storePlan(ValditionReqestPlan $request){

        $request->validated();

        $input['name'] = $request->name;
        $input['type'] = $request->type;
        $input['cost'] = $request->cost;
        $input['is_popular'] = $request->is_popular;

        $image = $request->file('image_path');
        if($image){
        $file_name = time() . '-' . $request->name . '.' . $image->extension();
        $image->move(public_path('uploads/Plans'), $file_name);

        $input['image_path'] =$file_name;

        }

        $plan = Plan::create($input);
        $plan->tags()->attach($request->tags);

        return redirect()->route('plan.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editPlan(Plan $plan) {
        $tags = Tag::whereStatus(1)->get(['id', 'name']);
        return view('plans.edit',compact('tags'),[
            'plan' => $plan,
            'name' => [
                'Basic' => 'Basic',
                'Advanced' => 'Advanced',
                'Professional' => 'Professional',
                'Golden' => 'Golden',


            ],
            'type' => [
                'Per Month' => 'Per Month',
                'Per Year' => 'Per Year',

            ],
        ]);
    }

    public function updatePlan(ValditionReqestPlan $request, Plan $plan){
        $request->validated();

        $input['name'] = $request->name;
        $input['type'] = $request->type;
        $input['cost'] = $request->cost;
        $input['is_popular'] = $request->is_popular;


        $image = $request->file('image_path');
        if($image){
        $file_name = time() . '-' . $request->name . '.' . $image->extension();
        $image->move(public_path('uploads/Plans'), $file_name);

        $input['image_path'] =$file_name;

        }

        $plan->update($input);
        $plan->tags()->sync($request->tags);

        return redirect()->route('plan.index')->with([
            'message' => 'updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroyPlan($id){

        $plan = Plan::find($id);

        if($plan->image_path !=null && File::exists('uploads/Plans/' . $plan->image_path)){
            unlink('uploads/Plans/' . $plan->image_path);
        }
        $plan->delete();
        return redirect('admin/plans')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {

        $plan = Plan::findOrFail($request->plan_id);
        if (File::exists('uploads/Plans/'. $plan->image_path)){
            unlink('uploads/Plans/'. $plan->image_path);
            $plan->image_path = null;
            $plan->save();
        }
        return true;
    }
}
