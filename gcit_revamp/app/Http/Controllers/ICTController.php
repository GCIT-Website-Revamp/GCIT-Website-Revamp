<?php

namespace App\Http\Controllers;

use App\Models\ICT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ICTController extends Controller
{
    public function getAllICT()
    {
        try {
            $ict = ICT::all();
            return response()->json([
                'success' => true,
                'data' => $ict
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch ict.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getICT(ICT $ict)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $ict
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch ict.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createICT(Request $request)
    {
        try {
            $rules = [
                'description' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $ict = new ICT();
            $ict->description = $request->description;
            $ict->save();

            return response()->json([
                'success' => true,
                'message' => 'ICT infomation added successfully!',
                'data' => $ict
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create ICT information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteICT($id)
    {
        try {
            $ict = ICT::findOrFail($id);
            $ict->delete();

            return response()->json([
                'success' => true,
                'message' => 'ICT infomation deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ict.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateICT($id, Request $request)
    {
        try {
            $ict = ICT::findOrFail($id);

            $rules = [
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $ict->description = $request->description;
            $ict->save();

            return response()->json([
                'success' => true,
                'message' => 'ICT infomation updated successfully!',
                'data' => $ict
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update ICT information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
