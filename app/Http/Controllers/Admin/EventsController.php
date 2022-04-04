<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\ValidationRequestEvent;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('id' , 'desc')->get();

        return view('events.index', [
            'events' => $events
        ]);
    }

    public function createEvent()
    {
        return view('events.create',[
            'event' => new Event ,
        ]);
    }

    public function storeEvent(ValidationRequestEvent $request)
    {
        //dd($request->all());
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['date'] = $request->input('date');
        $input['time'] = $request->input('time');


        $image = $request->file('image_path');

        if($image){
        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Events'), $file_name);

        $input['image_path'] =$file_name;

        }

        Event::create($input)->save();
         return redirect()->route('event.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function editEvent(Event $event){
        return view('events.edit' , [
            'event' => $event ,
        ]);
    }
    public function updateEvent(ValidationRequestEvent $request, Event $event){
        $request->validated();

        $input['title'] = $request->input('title');
        $input['summary'] = $request->input('summary');
        $input['date'] = $request->input('date');
        $input['time'] = $request->input('time');


        $image = $request->file('image_path');
        if($image){
            if($event->image_path !=null && File::exists('uploads/Events/' . $event->image_path)){
                unlink('uploads/Events/' . $event->image_path);

            }

        $file_name = time() . '-' . $request->title . '.' . $image->extension();
        $image->move(public_path('uploads/Events'), $file_name);

        $input['image_path'] =$file_name;
        }
        $event->update($input);
        return redirect()->route('event.index')
        ->with([
            'message' => 'Event updated successfully',
            'alert-type' => 'info'
        ]);
    }
    public function destroyEvent($id){
        $event = Event::find($id);

        if($event->image_path !=null && File::exists('uploads/Events/' . $event->image_path)){
            unlink('uploads/Events/' . $event->image_path);
        }
        $event->delete();
        return redirect('admin/events')->with([
            'message' => 'deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {

        $event = Event::findOrFail($request->event_id);
        if (File::exists('uploads/Events/'. $event->image_path)){
            unlink('uploads/Events/'. $event->image_path);
            $event->image_path = null;
            $event->save();
        }
        return true;
    }

}
