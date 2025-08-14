<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
    public function getAllVacancies()
    {
        // Fetch all Events from DB
        $vacancies = Vacancy::all();
        return response()->json($vacancies);
    }

    public function getVacancy(Vacancy $vacancy)
    {
        return response()->json($vacancy);
    }

    public function createVacancy(Request $request)
    {
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'candidates' => 'required',
            'documents' => 'required',
            'tor' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('vacancy')->withInput();
        }

        $vacancy = new Vacancy();
        $vacancy->name = $request->name;
        $vacancy->date = $request->date;
        $vacancy->documents = $request->documents;
        $vacancy->candidates = $request->candidates;
        $vacancy->tor = $request->tor;
        $vacancy->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('vacancy');
    }

    public function deleteVacancy($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('vacancy');
    }

    public function updateVacancy($id, Request $request)
    {

        $vacancy = Vacancy::findOrFail($id);
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'candidates' => 'required',
            'documents' => 'required',
            'tor' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('vacancy', $vacancy->id)->withInput()->withErrors($validator);
        }

         $vacancy->name = $request->name;
        $vacancy->date = $request->date;
        $vacancy->documents = $request->documents;
        $vacancy->candidates = $request->candidates;
        $vacancy->tor = $request->tor;
        $vacancy->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('vacancy');
    }
}
