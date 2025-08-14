<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EventController extends Controller
{
    public function getAllEvents()
    {
        // Fetch all Events from DB
        $events = Event::all();
        return response()->json($events);
    }

    public function getEvent(Event $event)
    {
        return response()->json($event);
    }

    public function createEvent(Request $request)
    {
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('event')->withInput();
        }

        $event = new Event();
        $event->name = $request->name;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('event');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('event');
    }

    public function updateEvent($id, Request $request)
    {

        $event = Event::findOrFail($id);
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('event', $event->id)->withInput()->withErrors($validator);
        }

        $event->name = $request->name;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('event');
    }
}
