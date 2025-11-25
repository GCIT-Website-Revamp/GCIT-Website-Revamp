<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
        try {
            $projects = Project::all();
            return response()->json([
                'success' => true,
                'data' => $projects
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch projects.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getProject(Project $project)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch project.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createProject(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'guide' => 'required',
                'description' => 'required',
                'developers' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'year' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $project = new Project();
            $project->name = $request->name;
            $project->guide = $request->guide;
            $project->description = $request->description;
            $project->developers = $request->developers;
            $project->year = $request->year;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('projects', $imageName, 'public');
                $project->image = $imagePath;
            }

            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project added successfully!',
                'data' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create project.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteProject($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete project.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProject($id, Request $request)
    {
        try {
            $project = Project::findOrFail($id);

            $rules = [
                'name' => 'required',
                'guide' => 'required',
                'description' => 'required',
                'developers' => 'required',
                'year' => 'required',
                // image is optional on update
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $project->name = $request->name;
            $project->guide = $request->guide;
            $project->description = $request->description;
            $project->developers = $request->developers;
            $project->year = $request->year;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('projects', $imageName, 'public');
                $project->image = $imagePath;
            }

            $project->save();

            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully!',
                'data' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update project.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
