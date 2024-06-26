<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index(Request $request)
    {
        $query = $request->input('search');
        $data = Article::query()
            ->where('title', 'like', "%$query%")
            ->orWhere('body', 'like', "%$query%")
            ->latest()
            ->paginate(5);


        return view('articles.index', ['articles' => $data]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view('articles.detail', ['article' => $data]);
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with('info', 'Article deleted');
        } else {
            return back()->with('error', 'Unauthorize');
        }
    }

    public function add()
    {
        $categories = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
            ["id" => 3, "name" => "Game"],
            ["id" => 4, "name" => "Service"],
            ["id" => 5, "name" => "Beauty"],
        ];

        return view('articles.add', ['categories' => $categories]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }

    public function edit($id)
    {
        $articler = Article::findOrFail($id);
        $categories = [
            ["id" => 1, "name" => "Tech"],
            ["id" => 2, "name" => "News"],
            ["id" => 3, "name" => "Game"],
            ["id" => 4, "name" => "Service"],
            ["id" => 5, "name" => "Beauty"],
        ];

        return view('articles.edit', compact('articler', 'categories'));
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = Article::findOrFail($id);

        if (Gate::allows('article-update', $article)) {
            $article->title = request()->title;
            $article->body = request()->body;
            $article->category_id = request()->category_id;
            $article->user_id = auth()->user()->id;
            $article->save();

            return redirect('/articles')->with('info', 'Article updated');
        } else {
            return back()->with('error', 'Unauthorized');
        }
    }
}
