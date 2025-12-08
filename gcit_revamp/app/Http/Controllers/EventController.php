<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    public function getAllEvents()
    {
        try {
            $events = Event::all();
            return response()->json([
                'success' => true,
                'data' => $events
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch events.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEvent(Event $event)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch event.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createEvent(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'description' => 'required',
                'display' => 'sometimes',
                'category' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $event = new Event();
            $event->name = $request->name;
            $event->date = $request->date;
            $event->display = $request->display;
            $event->category = $request->category;
            $event->description = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('events', $imageName, 'public');
                $event->image = $imagePath;
            }

            $event->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($event)
                ->withProperties([
                    'name' => $event->name,
                    'id' => $event->id
                ])
                ->log('Added a new event');
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully!',
                'data' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create event.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEvent($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($event)
                ->withProperties([
                    'name' => $event->name,
                    'id' => $event->id
                ])
                ->log('Deleted event');
            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete event.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateEvent($id, Request $request)
    {
        try {
            $event = Event::findOrFail($id);

            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'description' => 'required',
                'display' => 'sometimes',
                'category' => 'required',
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $event->name = $request->name;
            $event->date = $request->date;
            $event->description = $request->description;
            $event->category = $request->category;
            $event->display = $request->display;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('events', $imageName, 'public');
                $event->image = $imagePath;
            }

            $event->save();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($event)
                ->withProperties([
                    'name' => $event->name,
                    'id' => $event->id
                ])
                ->log('Updated event');
            return response()->json([
                'success' => true,
                'message' => 'Event updated successfully!',
                'data' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update event.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}