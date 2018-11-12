<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    //
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {

        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));

    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(CreateArticleRequest $request)
    {
        Article::forceCreate($request->except(['_token']));

        return redirect('articles');
    }
}
