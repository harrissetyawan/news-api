<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Http\Resources\SingleNewsResource;
use App\Models\Comments;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class NewsController extends Controller implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    public function index()
    {
        return NewsResource::collection(News::paginate(2));
    }

    public function show($id)
    {
        $news = News::with('comments')->findOrFail($id);
        return new SingleNewsResource($news);
    }

    public function store(Request $request)
    {

        if (Gate::allows('created', News::class)) {
            $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:955',
                'img' => 'required|image'
            ]);
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . '-' . Str::random(10) . '-' . Str::random(10) . '.' . $extension;
            $filePath = $image->storeAs('public/images', $fileName);
            $news = News::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'img' => $fileName,
            ]);

            Logs::create([
                'news_id' => $news->id,
                'action' => 'created'
            ]);

            return (new NewsResource(News::find($news->id)))
                ->response();
        }

        return response()->json(['error' => 'Unauthorized'], 201);
    }

    public function update(Request $request, $id)
    {

        if (Gate::allows('updated', News::class)) {
            $validator = $request->validate([
                'title' => 'required',
                'content' => 'required',
                'img' => 'required|image'
            ]);
            $image = $request->file('img');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . '-' . Str::random(10) . '-' . Str::random(10) . '.' . $extension;
            $NewsUpdate = News::findOrFail($id);
            $NewsUpdate->title = $validator['title'];
            $NewsUpdate->content = $validator['content'];
            $NewsUpdate->img = $fileName;
            $NewsUpdate->save();
            Logs::create([
                'news_id' => $id,
                'action' => 'updated'
            ]);
            return (new NewsResource(News::find($id)))
                ->response();
        }
        return response()->json(['error' => 'Unauthorized'], 200);
    }

    public function destroy(News $news)
    {
        if (Gate::allows('deleted', $news)) {
            $news->delete();
            // Record The Log
            Logs::create([
                'news_id' => $news->id,
                'action' => 'deleted'
            ]);
            return response()->json(['message' => 'News deleted sucessfully'], 204);
        }
        return response()->json(['error' => 'Unauthorized'], 201);
    }
}
