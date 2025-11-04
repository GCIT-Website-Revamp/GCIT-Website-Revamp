<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAllCourses()
    {
        // Fetch all Events from DB
        $courses = Course::all();
        return response()->json($courses);
    }

    public function getCourse(Course $course)
    {
        return response()->json($course);
    }

    public function createCourse(Request $request)
    {
        $rules = [
            'name' => 'required',
            'why' => 'required',
            'what' => 'required',
            'structure' => 'required',
            'careeer' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
        }

        $course = new Course();
        $course->name = $request->name;
        $course->why = $request->why;
        $course->what = $request->what;
        $course->structure = $request->structure;
        $course->career = $request->career;
        $course->save();
        session()->flash('success', 'Added Successfully');
        return redirect('/admin/academics');
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);

        $course->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('course');
    }

    public function updateCourse($id, Request $request)
    {

        $course = Course::findOrFail($id);
        $rules = [
             'name' => 'required',
            'why' => 'required',
            'what' => 'required',
            'structure' => 'required',
            'careeer' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('course', $course->id)->withInput()->withErrors($validator);
        }

        $course->name = $request->name;
        $course->why = $request->why;
        $course->what = $request->what;
        $course->structure = $request->structure;
        $course->career = $request->career;
        $course->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('course');
    }
}
