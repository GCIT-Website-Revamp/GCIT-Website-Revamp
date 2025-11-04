<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    public function getAllModules()
    {
        // Fetch all Events from DB
        $modules = Module::all();
        return response()->json($modules);
    }

    public function getModule(Module $module)
    {
        return response()->json($module);
    }

    public function createModule(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'year' => 'required',
            'semester' => 'required',
            'course_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
        }

        $module = new Module();
        $module->name = $request->name;
        $module->description = $request->description;
        $module->year = $request->year;
        $module->semester = $request->semester;
        $module->course_id = $request->course_id;
        $module->save();
        session()->flash('success', 'Added Successfully');
        return redirect('/admin/academics');
    }

    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);

        $module->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('module');
    }

    public function updateModule($id, Request $request)
    {

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
            return redirect()->route('module', $module->id)->withInput()->withErrors($validator);
        }

        $module->name = $request->name;
        $module->description = $request->description;
        $module->year = $request->year;
        $module->semester = $request->semester;
        $module->course_id = $request->course_id;
        $module->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('module');
    }
}
