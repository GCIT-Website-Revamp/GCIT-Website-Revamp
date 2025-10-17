<?php

namespace App\Http\Controllers;

use App\Models\ClubRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubRoleController extends Controller
{
    public function getAllCRoles()
    {
        // Fetch all Events from DB
        $croles = ClubRoles::all();
        return response()->json($croles);
    }

    public function getCRole(ClubRoles $croles)
    {
        return response()->json($croles);
    }

    public function createCRoles(Request $request)
    {
        $rules = [
            'rname' => 'required',
            'pname' => 'required',
            'image' => 'required',
            'club_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('croles')->withInput();
        }

        $croles = new ClubRoles();
        $croles->rname = $request->rname;
        $croles->pname = $request->pname;
        $croles->image = $request->image;
        $croles->club_id = $request->club_id;
        $croles->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('croles');
    }

    public function deleteCRoles($id)
    {
        $croles = ClubRoles::findOrFail($id);

        $croles->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('croles');
    }

    public function updateCRoles($id, Request $request)
    {

        $croles = ClubRoles::findOrFail($id);
        $rules = [
             'rname' => 'required',
            'pname' => 'required',
            'image' => 'required',
            'club_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('croles', $croles->id)->withInput()->withErrors($validator);
        }

        $croles->rname = $request->rname;
        $croles->pname = $request->pname;
        $croles->image = $request->image;
        $croles->club_id = $request->club_id;
        $croles->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('croles');
    }
}
