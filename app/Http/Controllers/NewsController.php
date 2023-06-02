<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Http\Resources\SingleNewsResource;
use App\Models\Comments;
use App\Models\User;

class NewsController extends Controller
{
    public function index()
    {
        return NewsResource::collection(News::all());
    }

    public function show($id)
    {
        $news = News::with('comments')->findOrFail($id);
        return new SingleNewsResource($news);
    }
}
