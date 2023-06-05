<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\CommentJob;

class CommentController extends Controller
{
    public function index()
    {
        return CommentsResource::collection(Comments::all());
    }
    public function show($id)
    {
        return new CommentsResource(Comments::findOrFail($id));
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'news_id' => 'required',
            'comment' => 'required|max:125'
        ]);
        $comment = Comments::create([
            'user_id' => Auth::id(),
            'news_id' => $request->news_id,
            'comment' => $request->comment
        ]);
        // dispatch(new CommentJob($validator, Auth::id()));
        // return (new CommentsResource(Comments::where('news_id', $request->news_id)->get()))->response();
        return new CommentsResource(Comments::findOrFail($comment->id));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'comment' => 'required'
        ]);

        $updateComment = Comments::findOrFail($id);
        $updateComment->comment = $validator['comment'];
        $updateComment->save();

        return (new CommentsResource(Comments::find($id)))
            ->response();
    }
    public function destroy(Comments $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'deleted sucessfully'], 204);
    }
}
