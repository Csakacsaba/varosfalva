<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{

    public function index() {
        return view('contents.comments', [
            'comments' => Comment::query()->with('user')
                ->addSelect(['likeNr'=> Like::query()
                    ->selectRaw('count(*)')
                    ->where('likeNr', 1)
                    ->whereColumn('comment_id', 'comments.id')])
                ->addSelect(['dislikeNr'=> Like::query()
                    ->selectRaw('count(*)')
                    ->whereColumn('comment_id', 'comments.id')
                ->where('likeNr', 0)])
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'=>'required|min:5|max:2500'
        ]);


        Mail::to('varosfalva5@gmail.com')->send(new TestEmail($request));
        Comment::create([
           'text'=>$request->text,
           'user_id'=>auth()->user()->id
        ]);
        return redirect('/contact');
    }

    public function like(Request $request)      //ez kommunial a js-el
    {
        if ($request->ajax()) {
            $commentId = $request->input('comment_id');
            $userId = $request->input('user_id');
            $like = Like::where('comment_id', $commentId)
                ->where('user_id', $userId)
                ->first();
            if ($like) {
                $like->likeNr = 1;

                $like->save();
            } else {
                Like::create([
                    'comment_id' => $commentId,
                    'user_id' => $userId,
                    'likeNr' => 1,
                    ]);
            }
            return response([
                'like' => Like::where('likeNr', 1)->where('comment_id', $commentId)->count(),
                'dislike' => Like::where('likeNr', 0)->where('comment_id', $commentId)->count()
                ]);
            
        }
    }

    public function dislike(Request $request)      //ez kommunial a js-el
    {
        if ($request->ajax()) {
            $commentId = $request->input('comment_id');
            $userId = $request->input('user_id');

            $like = Like::where('comment_id', $commentId)
                ->where('user_id', $userId)
                ->first();
            if ($like) {
                $like->likeNr = 0;
                $like->save();
            } else {
                Like::create([
                    'comment_id' => $commentId,
                    'user_id' => $userId,
                    'likeNr' => 0,
                ]);
            }
            return response([
                'like' => Like::where('likeNr', 1)->where('comment_id', $commentId)->count(),
                'dislike' => Like::where('likeNr', 0)->where('comment_id', $commentId)->count()
            ]);

        }
    }


    public function search(){
        return view('contents.comments', [
            'comments' => Comment::with('user')
                ->where('text', 'like', '%'. request('search') . '%')
                ->orWhereHas('user', function ($query) { //igy mar akkor a userben keresek
                    $query->where('name', 'like', '%'. request('search') . '%');
                })
                ->orderBy('accepted', 'desc')
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function delete(Request $request)
    {
        $commentId = $request['comment_id'];
        if (Auth::check()) {
            $userId = Auth::user()->id;

            $comment = Comment::where('id', $commentId)
                ->where('user_id', $userId)
                ->first();

            if ($comment) {
                $comment->delete();
            }
        }
        return redirect()->route('contact');
    }
}
