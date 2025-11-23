<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
    public function getAllVacancies()
    {
        try {
            $vacancies = Vacancy::all();
            return response()->json([
                'success' => true,
                'data' => $vacancies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vacancies.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getVacancy(Vacancy $vacancy)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vacancy.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createVacancy(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'candidates' => 'required',
                'documents' => 'required',
                'tor' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $vacancy = new Vacancy();
            $vacancy->name = $request->name;
            $vacancy->date = $request->date;
            $vacancy->documents = $request->documents;
            $vacancy->candidates = $request->candidates;
            $vacancy->tor = $request->tor;
            $vacancy->save();

            return response()->json([
                'success' => true,
                'message' => 'Vacancy created successfully!',
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create vacancy.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteVacancy($id)
    {
        try {
            $vacancy = Vacancy::findOrFail($id);
            $vacancy->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vacancy deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete vacancy.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateVacancy($id, Request $request)
    {
        try {
            $vacancy = Vacancy::findOrFail($id);

            $rules = [
                'name' => 'required',
                'date' => 'required|date',
                'candidates' => 'required',
                'documents' => 'required',
                'tor' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $vacancy->name = $request->name;
            $vacancy->date = $request->date;
            $vacancy->documents = $request->documents;
            $vacancy->candidates = $request->candidates;
            $vacancy->tor = $request->tor;
            $vacancy->save();

            return response()->json([
                'success' => true,
                'message' => 'Vacancy updated successfully!',
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update vacancy.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}