<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getAllCourses()
    {
        try {
            $courses = Course::all();
            return response()->json([
                'success' => true,
                'data' => $courses
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch courses.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCourse(Course $course)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch course.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createCourse(Request $request)
    {
        try {
            $rules = [
                'name' => 'required',
                'why' => 'required',
                'what' => 'required',
                'structure' => 'required',
                'career' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $course = new Course();
            $course->name = $request->name;
            $course->why = $request->why;
            $course->what = $request->what;
            $course->structure = $request->structure;
            $course->career = $request->career;
            $course->save();

            return response()->json([
                'success' => true,
                'message' => 'Course created successfully!',
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create course.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCourse($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return response()->json([
                'success' => true,
                'message' => 'Course deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete course.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCourse($id, Request $request)
    {
        try {
            $course = Course::findOrFail($id);

            $rules = [
                'name' => 'required',
                'why' => 'required',
                'what' => 'required',
                'structure' => 'required',
                'career' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $course->name = $request->name;
            $course->why = $request->why;
            $course->what = $request->what;
            $course->structure = $request->structure;
            $course->career = $request->career;
            $course->save();

            return response()->json([
                'success' => true,
                'message' => 'Course updated successfully!',
                'data' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update course.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}