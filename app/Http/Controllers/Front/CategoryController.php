<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected  $paginate = 10;

    public function index(Request $request, $slug)
    {
        $page = Page::where('slug', 'rubrika')->where('status', true)->first();

        if(!$page) {
            abort(404);
        }

        $category = Category::visible()->where('slug', $slug)->first();

        if (!$category) {
            abort(404);
        }

        $this->data(['category' => $category]);
        $this->data(['page' => $page]);

        $per_page = $request->get('per_page') ?? $this->paginate;

        $articles = Article::with('category')->where('category_id', $category->id)
            ->where(function ($q){
            $q->whereNull('publication_date')
                ->orWhere('publication_date', '<', Carbon::now());
        })
            ->visible()
            ->positionSorted();

        $articles_count = $articles->count();

        $articles = $articles->paginate($per_page)->appends(request()->query());

        $tags = $category->tags->where('status', 1);

        $this->data([
            'articles_count' => $articles_count,
            'articles'       => $articles,
            'tags'           => $tags,
            'title'            => $category->title ? $category->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $category->meta_title ? $category->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $category->description ? $category->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $category->meta_description ? $category->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        if ($articles_count > $per_page) {
            $this->data(['paginate_count' => $per_page]);
        }

        $this->setDefaultData();

        return $this->render('category');
    }
}
