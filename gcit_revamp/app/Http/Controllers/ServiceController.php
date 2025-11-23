<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function getAllServices()
    {
        try {
            $services = Services::all();
            return response()->json([
                'success' => true,
                'data' => $services
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch services.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getService(Services $service)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $service
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createService(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $service = new Services();
            $service->name = $request->name;
            $service->description = $request->description;
            $service->roles = $request->roles;

            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Service created successfully!',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteService($id)
    {
        try {
            $service = Services::findOrFail($id);
            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateService($id, Request $request)
    {
        try {
            $service = Services::findOrFail($id);

            $rules = [
                'name' => 'required',
                'description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $service->name = $request->name;
            $service->description = $request->description;
            $service->roles = $request->roles;

            $service->save();

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully!',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update service.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}