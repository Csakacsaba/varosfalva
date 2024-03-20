<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin/admin');
    }
    public function index() {
        return view('admin.admin', [
            'comments' => Comment::with('user')->orderBy('created_at', 'desc')->get(),
            'users' => User::all(),
        ]);
    }
    public function delete_comment(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin');
    }

    public function accept_comment(Comment $comment)
    {
//        dd($comment);
        $comment->update(['accepted' => 1]);
        return redirect()->route('admin');
    }

    public function delete_image(Media $media)
    {
        $type = $media->collection_name;
        $media->delete();

        return redirect()->route('kepek', ['type' => $type]);
    }

    public function bann_user(User $user)
    {
        $user->banned = true;
        $user->save();
        return back();
    }

    public function unlock_user(User $user)
    {
        $user->banned = false;
        $user->save();
        return back();
    }
}
