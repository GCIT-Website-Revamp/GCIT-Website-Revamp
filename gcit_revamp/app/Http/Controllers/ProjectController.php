<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
        // Fetch all Projects from DB
        $projects = Project::all();
        return response()->json($projects);
    }

    public function getProject(Project $project)
    {
        return response()->json($project);
    }

    public function createProject(Request $request)
    {
        $rules = [
            'name' => 'required',
            'guide' => 'required',
            'description' => 'required',
            'developers' => 'required',
            'image' => 'required',
            'year' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('project')->withInput();
        }

        $project = new Project();
        $project->name = $request->name;
        $project->guide = $request->guide;
        $project->description = $request->description;
        $project->developers = $request->developers;
        $project->image = $request->image;
        $project->year = $request->year;
        $project->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('project');
    }

    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('project');
    }

    public function updateProject($id, Request $request)
    {

        $project = Project::findOrFail($id);
        $rules = [
            'name' => 'required',
            'guide' => 'required',
            'description' => 'required',
            'developers' => 'required',
            'image' => 'required',
            'year' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('project', $project->id)->withInput()->withErrors($validator);
        }

        $project->name = $request->name;
        $project->guide = $request->guide;
        $project->description = $request->description;
        $project->developers = $request->developers;
        $project->image = $request->image;
        $project->year = $request->year;
        $project->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('project');
    }
}
