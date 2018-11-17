<?php

namespace App\Http\Controllers;

use App\Article;
//use Carbon\Carbon;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * [ArticlesController description]
 */
class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

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
        if(Auth::guest()){
            return redirect('articles');
        }
        return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
        //Article::forceCreate($request->except(['_token']));
        $article = new Article();
        $article->forceFill($request->except(['_token']));
        \Auth::user()->articles()->save($article);
        return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);
        $article->forceFill($request->except(['_token','_method']))->save();
        return redirect('articles');
    }

}
