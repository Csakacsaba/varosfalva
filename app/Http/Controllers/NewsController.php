<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        return view('contents.news_user', [
            'news' => News::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function news_admin()
    {
        return view('admin.news_admin', [
            'news' => News::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function news_store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'required'
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        $news = new News();
        $news->title = $validatedData['title' ];
        $news->content = $validatedData['content'];
        $news->author = $validatedData['author'];
        $news->image = $imagePath;
        $news->save();

        return redirect()->back()->with('success', 'News article uploaded successfully');
    }

    public function news_delete(News $new)
    {
        $new->delete();
        return redirect()->back();
    }
}
