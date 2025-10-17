<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    public function getAllClubs()
    {
        // Fetch all clubs from DB
        $clubs = Club::all();
        return response()->json($clubs);
    }

    public function getClub(Club $club)
    {
        return response()->json($club);
    }

    public function createClub(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('club')->withInput();
        }

        $club = new Club();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->image = $request->image;
        $club->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('club');
    }

    public function deleteClub($id)
    {
        $club = Club::findOrFail($id);

        $club->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('club');
    }

    public function updateClub($id, Request $request)
    {

        $club = Club::findOrFail($id);
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('club', $club->id)->withInput()->withErrors($validator);
        }

        $club->name = $request->name;
        $club->description = $request->description;
        $club->image = $request->image;
        $club->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('club');
    }
}
