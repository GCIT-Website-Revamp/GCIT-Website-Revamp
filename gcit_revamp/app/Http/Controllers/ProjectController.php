<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;

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
                'display' => 'sometimes',
                'highlight' => 'sometimes',
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
            $project->display = $request->display;
            $project->highlight = $request->highlight;
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

            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $file) {
                    $path = $file->store('projects', 'public');

                    $project->images()->create([
                        'image_path' => $path
                    ]);
                }
            }

            activity()
                ->causedBy(Auth::user())
                ->performedOn($project)
                ->withProperties([
                    'project_name' => $project->name,
                    'project_id' => $project->id
                ])
                ->log('Created a new project');

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
            activity()
                ->causedBy(Auth::user())
                ->performedOn($project)
                ->withProperties([
                    'project_name' => $project->name,
                    'project_id' => $project->id
                ])
                ->log('Deleted a project');

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
                'display' => 'sometimes',
                'highlight' => 'sometimes',
                'developers' => 'required',
                'year' => 'required',
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
            $project->display = $request->display;
            $project->highlight = $request->highlight;
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

            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $file) {
                    $path = $file->store('projects', 'public');

                    $project->images()->create([
                        'image_path' => $path
                    ]);
                }
            }
            activity()
                ->causedBy(Auth::user())
                ->performedOn($project)
                ->withProperties([
                    'project_name' => $project->name,
                    'project_id' => $project->id
                ])
                ->log('Updated project details');

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

    public function deleteImage($id)
        {
            $image = ProjectImage::find($id);

            if (!$image) {
                return response()->json(['success' => false, 'message' => 'Image not found']);
            }

            Storage::disk('public')->delete($image->image_path);
            $image->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($image)
                ->withProperties([
                    'project_image_path' => $image->imagepath
                ])
                ->log('Deleted project Image');

            return response()->json(['success' => true, 'message' => 'Image deleted']);
        }
}
