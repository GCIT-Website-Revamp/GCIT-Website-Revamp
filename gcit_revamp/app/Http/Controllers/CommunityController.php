<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Community;

class CommunityController extends Controller
{
    public function createCommunity(Request $request)
    {
        $rules = [
            'student' => 'required',
            'acad' => 'required',
            'nAcad' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('community')->withInput();
        }

        $community = new Community();
        $community->student = $request->student;
        $community->acad = $request->acad;
        $community->nAcad = $request->nAcad;
        $community->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('community');
    }

    public function deleteCommunity($id)
    {
        $community = Community::findOrFail($id);

        $community->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('community');
    }

    public function updateCommunity($id, Request $request)
    {

        $community = Community::findOrFail($id);
        $rules = [
            'student' => 'required',
            'acad' => 'required',
            'nAcad' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('community', $community->id)->withInput()->withErrors($validator);
        }

        $community->name = $request->name;
        $community->description = $request->description;
        $community->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('community');
    }
}
