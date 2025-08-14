<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getAllNews()
    {
        // Fetch all Events from DB
        $news = News::all();
        return response()->json($news);
    }

    public function getNews(News $news)
    {
        return response()->json($news);
    }

    public function createNews(Request $request)
    {
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Set the error messages in the session
            session()->flash('errors', $validator->errors()->all());
            return redirect()->route('news')->withInput();
        }

        $news = new News();
        $news->name = $request->name;
        $news->date = $request->date;
        $news->description = $request->description;
        $news->save();
        session()->flash('success', 'Added Successfully');
        return redirect()->route('news');
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);

        $news->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('news');
    }

    public function updateNews($id, Request $request)
    {

        $news = News::findOrFail($id);
        $rules = [
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('news', $news->id)->withInput()->withErrors($validator);
        }

        $news->name = $request->name;
        $news->date = $request->date;
        $news->description = $request->description;
        $news->save();

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('news');
    }
}
