<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
class MediaController extends Controller
{
    public function getAllMedias()
    {
        try {
            $medias = Media::all();
            return response()->json([
                'success' => true,
                'data' => $medias
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMedia(Media $media)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $media
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch media.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createMedia(Request $request)
    {
        try {
            $rules = [
                'position' => 'required|unique:media,position',
                'title' => 'required',
                'media' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $media = new Media();
            $media->position = $request->position;
            $media->title = $request->title;

            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('media', $fileName, 'public');
                $media->media = $filePath;
            }

            $media->save();

            activity()
                ->causedBy(Auth::user())
                ->performedOn($media)
                ->withProperties([
                    'title' => $media->title,
                    'id' => $media->id
                ])
                ->log('Added a new media');
            return response()->json([
                'success' => true,
                'message' => 'Media added successfully!',
                'data' => $media
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create media.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteMedia($id)
    {
        try {
            $media = Media::findOrFail($id);
            $media->delete();
            activity()
                ->causedBy(Auth::user())
                ->performedOn($media)
                ->withProperties([
                    'title' => $media->title,
                    'id' => $media->id
                ])
                ->log('Deleted media');
            return response()->json([
                'success' => true,
                'message' => 'Media deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete media.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMedia($id, Request $request)
    {
        try {
            $media = Media::findOrFail($id);

            $rules = [
                'position' => 'required|unique:media,position,' . $media->id,
                'title' => 'required',
                'media' => 'nullable|file'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $media->position = $request->position;
            $media->title = $request->title;

            if ($request->hasFile('media')) {

                $file = $request->file('media');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('media', $fileName, 'public');

                $media->media = $filePath;
            }

            $media->save();

            return response()->json([
                'success' => true,
                'message' => 'Media updated successfully!',
                'data' => $media
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update media.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}