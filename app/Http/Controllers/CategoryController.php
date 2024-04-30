<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $articles = $category->articles()->paginate(5);
        return view('articles.categories',   ['articles' => $articles, 'category' => $category]);
    }
}
