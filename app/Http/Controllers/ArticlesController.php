<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Article;
use Carbon\Carbon;

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
        //dd($article->published_at);
        // if( is_null($article) ) {
        //     abort(404);
        // }
        return view('articles.show', compact('article'));

    }

    public function create()
    {
        return view('articles.create');
    }

    public function store()
    {
        $input = Request::all();
//        $input['published_at'] = Carbon::now();
        $article = new Article;
        $article->title = $input['title'];
        $article->body = $input['body'];
        $article->published_at = $input['published_at'];
        $article->save();
//      Article::forceCreate(Request::all());
        return redirect('articles');

    }
}
