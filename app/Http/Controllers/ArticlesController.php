<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
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
        // $latest = Article::latest()->first();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        if(Auth::guest()){
            return redirect('articles');
        }

        $tags = Tag::pluck('name', 'id');
        $tagarray = array();
        return view('articles.create', compact('tags', 'tagarray'));
    }

    public function store(ArticleRequest $request)
    {
        //Article::forceCreate($request->except(['_token']));

        $article = new Article();
        $article->forceFill($request->except(['_token','tag_list']));
        Auth::user()->articles()->save($article);

        //dd($request->input('tags'));

        // \Session::flash('flash_message', 'Your article has been created!');
        //session()->flash('flash_message', 'Your article has been created!');

        $article->tags()->attach($request->input('tag_list'));

        return redirect('articles')->with([
            'flash_message' => 'Some text',
        ]);
    }

    public function edit(Article $article)
    {
        $tags = Tag::pluck('name', 'id');
        $tagarray = $article->tags->pluck('id')->toArray();
        //dd($tagarray);
        return view('articles.edit', compact('article', 'tags', 'tagarray'));
    }

    public function update(Article $article, ArticleRequest $request)
    {
        $article->forceFill($request->except(['_token','_method','tag_list']))->save();
        $article->tags()->sync($request->input('tag_list'));
        return redirect('articles');
    }

}
