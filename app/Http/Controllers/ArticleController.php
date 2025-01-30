<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Article;
use App\Models\Tag;
use App\Jobs\ProcessComment;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        // получение последних 6 записей
        $articles = Article::orderBy('id', 'desc')->take(6)->get();
        return Inertia::render('Index', [
            'articles' => $articles->sortBy([['created_at', 'desc']]),
        ]);
    }

    public function articles()
    {
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        $tags = Tag::all();
        return Inertia::render('Articles/Main', [
            'articles'  => $articles,
            'tags'      => $tags,
        ]);
    }

    public function articlesDetails($id)
    {
        $article = Article::find($id);
        return Inertia::render('Articles/Details', [
            'article' => $article,
        ]);
    }

    public function addComment(CommentRequest $request, $id): JsonResponse
    {
        sleep(30);

        $validatedData = $request->validated();
        $validatedData['status'] = 'In processing';

        ProcessComment::dispatch($id, $validatedData);

        $article = Article::find($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Comment created and sent for moderation',
            'value'      => $article->comments,
        ], 201);
    }

    public function incrementLikes($id): JsonResponse
    {
        $article = Article::find($id);

        if ($article) {
            $article->increment('likes');
        }

        $responseStatusCode = $article ? 200 : 401;
        $response = [
            'success'   => $article ? true : false,
            'message'   => $article ? 'Likes count incremented successfully.' : 'Article with id = '.$id.', not found',
            'value'     => $article->likes,
        ];

        return response()->json($response, $responseStatusCode);
    }

    public function incrementViews($id): JsonResponse
    {
        $article = Article::find($id);

        if ($article) {
            $article->increment('views');
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Views count incremented successfully.',
            'value'     => $article->views,
        ]);
    }
}
