<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

class ServiceController extends Controller
{
    public function getAllServices()
    {
        // Fetch all Services from DB
        $services = Services::all();
        return response()->json($services);
    }

    public function getService(Services $service)
    {
        return response()->json($service);
    }

    public function createService(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('service')->withInput();
        }

        $service = new Services();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->image = $request->image;
        $service->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('service');
    }

    public function deleteService($id)
    {
        $service = Services::findOrFail($id);

        $service->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('service');
    }

    public function updateService($id, Request $request)
    {

        $service = Services::findOrFail($id);
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('service', $service->id)->withInput()->withErrors($validator);
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->image = $request->image;
        $service->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('service');
    }
}
