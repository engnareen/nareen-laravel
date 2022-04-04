<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ValidationRequestWork;

class WorksController extends Controller
{
    public function index()
    {
        $works = Work::get();

        return view('works.index', [
            'works' => $works
        ]);
    }

    public function createWork()
    {
        return view('works.create',[
            'work' => new Work ,
        ]);
    }

    public function storeWork(ValidationRequestWork $request)
    {
        //dd($request->all());
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['date'] = $request->input('date');

        $image = $request->file('image_path');

        if($image){
        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Works'), $file_name);

        $input['image_path'] =$file_name;

        }

        Work::create($input)->save();
        return redirect()->route('work.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editWork(Work $work){
        return view('works.edit' , [
            'work' => $work ,
        ]);
    }
    public function updateWork(ValidationRequestWork $request, Work $work){
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['date'] = $request->input('date');

        $image = $request->file('image_path');
        if($image){
            if($work->image_path !=null && File::exists('uploads/Works/' . $work->image_path)){
                unlink('uploads/Works/' . $work->image_path);

            }

        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Works'), $file_name);

        $input['image_path'] =$file_name;
        }
        $work->update($input);
        return redirect()->route('work.index')
        ->with([
            'message' => 'work updated successfully',
            'alert-type' => 'info'
        ]);
    }
    public function destroyWork($id){
        $work = Work::find($id);

        if($work->image_path !=null && File::exists('uploads/Works/' . $work->image_path)){
            unlink('uploads/Works/' . $work->image_path);
        }
        $work->delete();
        return redirect('admin/works')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {

        $work = Work::findOrFail($request->work_id);
        if (File::exists('uploads/Works/'. $work->image_path)){
            unlink('uploads/Works/'. $work->image_path);
            $work->image_path = null;
            $work->save();
        }
        return true;
    }

}
