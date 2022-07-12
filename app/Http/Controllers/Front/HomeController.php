<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LocaleMiddleware;
use App\Models\Article;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    protected  $slider_limit = 5;

    protected  $paginate = 10;

    public function index(\Illuminate\Http\Request $request)
    {
        if ($request->get('search')) {
            return $this->search($request);
        }

        $page = Page::where('slug', 'media')->where('status', true)->first();

        if(!$page) {
            abort(404);
        }

        $slider_articles = Article::where(function ($q){
            $q->whereNull('publication_date')
                ->orWhere('publication_date', '<', Carbon::now());
        })
            ->visible()
            ->positionSorted()
            ->limit($this->slider_limit)
            ->get();

        $per_page = $request->get('per_page') ?? $this->paginate;

        $article_list = Article::with('category')->where(function ($q){
            $q->whereNull('publication_date')
                ->orWhere('publication_date', '<', Carbon::now());
        })
            ->visible()
            ->positionSorted();

        $articles_count = $article_list->count();

        $article_list = $article_list->paginate($per_page)
            ->appends(request()->query());

        if($articles_count > $per_page) {
            $this->data(['paginate_count' => $per_page]);
        }

        $this->data([
            'article_list'     => $article_list,
            'slider_articles'  => $slider_articles,
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        $this->setDefaultData();

        return $this->render('hello');
    }

    public function page_not_found()
    {
        $data['locales'] = LocaleMiddleware::$languages;

        $data['current_local'] = app()->getLocale();

        return view('404', $data);
    }

    public function setLocale($lang)
    {
        $referer = Redirect::back()->getTargetUrl();
        $parse_url = parse_url($referer, PHP_URL_PATH);
        $segments = explode('/', $parse_url);

        if (isset($segments[1]) && in_array($segments[1], LocaleMiddleware::$languages)) {
            unset($segments[1]);
        }

        if (LocaleMiddleware::$mainLanguage !== $lang){
            array_splice($segments, 1, 0, $lang);
        }

        $url = str_replace('/public','',Request::root()).implode("/", $segments);

        if(parse_url($referer, PHP_URL_QUERY)) {
            $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
        }

        return redirect($url);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $page = Page::where('slug', 'search')->first();

        if(!$page) {
            abort(404);
        }

        $search = $request->get('search');

        $per_page = $request->get('per_page') ?? $this->paginate;

        $articles = Article::with('translation')
            ->where(function ($q){
                $q->whereNull('publication_date')
                    ->orWhere('publication_date', '<', Carbon::now());
            })
            ->whereHas('translation', function ($q) use($search){
            $q->where('title', 'LIKE', '%' . $search . '%');
        })
            ->visible()
            ->positionSorted();

        $article_count = $articles->count();

        $articles = $articles->paginate($per_page)
            ->appends(request()->query());

        $this->data([
            'articles'       => $articles,
            'article_count'  => $article_count,
            'search_value'   => $search,
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        if ($article_count > $per_page) {
            $this->data(['paginate_count' => $per_page]);
        }

        $this->setDefaultData();

        return $this->render('search');
    }
}
