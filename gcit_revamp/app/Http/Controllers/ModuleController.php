<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function getAllModules()
    {
        try {
            $modules = Module::all();
            return response()->json([
                'success' => true,
                'data' => $modules
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch modules.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getModule(Module $module)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $module
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch module.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createModule(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'year' => 'required',
                'semester' => 'required',
                'course_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $module = new Module();
            $module->name = $request->name;
            $module->description = $request->description;
            $module->year = $request->year;
            $module->semester = $request->semester;
            $module->course_id = $request->course_id;
            $module->save();

            return response()->json([
                'success' => true,
                'message' => 'Module created successfully!',
                'data' => $module
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create module.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteModule($id)
    {
        try {
            $module = Module::findOrFail($id);
            $module->delete();

            return response()->json([
                'success' => true,
                'message' => 'Module deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete module.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateModule($id, Request $request)
    {
        try {
            $module = Module::findOrFail($id);

            $rules = [
                'name' => 'required',
                'description' => 'required',
                'year' => 'required',
                'semester' => 'required',
                'course_id' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $module->name = $request->name;
            $module->description = $request->description;
            $module->year = $request->year;
            $module->semester = $request->semester;
            $module->course_id = $request->course_id;
            $module->save();

            return response()->json([
                'success' => true,
                'message' => 'Module updated successfully!',
                'data' => $module
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update module.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}