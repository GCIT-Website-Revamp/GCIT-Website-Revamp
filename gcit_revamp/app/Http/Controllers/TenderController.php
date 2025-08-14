<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TenderController extends Controller
{
   public function getAllTenders()
    {
        // Fetch all Events from DB
        $tenders = Tender::all();
        return response()->json($tenders);
    }

    public function getTender(Tender $tender)
    {
        return response()->json($tender);
    }

    public function createTender(Request $request)
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
            return redirect()->route('tender')->withInput();
        }

        $tender = new Tender();
        $tender->name = $request->name;
        $tender->date = $request->date;
        $tender->description = $request->description;
        $tender->image = $request->image;
        $tender->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('tender');
    }

    public function deleteTender($id)
    {
        $tender = Tender::findOrFail($id);

        $tender->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('tender');
    }

    public function updateTender($id, Request $request)
    {

        $tender = Tender::findOrFail($id);
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('tender', $tender->id)->withInput()->withErrors($validator);
        }

        $tender->name = $request->name;
        $tender->date = $request->date;
        $tender->description = $request->description;
        $tender->image = $request->image;
        $tender->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('tender');
    }
}
