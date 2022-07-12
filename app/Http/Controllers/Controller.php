<?php

namespace App\Http\Controllers;

use App\Classes\Meta;
use App\Http\Middleware\LocaleMiddleware;
use App\Models\Category;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $viewData = [];

    public function render($view = '', array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $this->data($k, $v);
            }
        }

        if (empty($view) || !view()->exists($view)) {
            $view = $this->_view;
        }

        if (view()->exists($view)) {
            return view($view, $this->viewData)->with('messages', 'щзф')->render();
        }

        throw new Exception('View not found', 500);
    }

    public function data( /*array or pair of values*/)
    {
        $data = func_get_args();

        if (!empty($data)) {
            if (count($data) > 1) {
                $this->viewData[$data[0]] = $data[1];
            } elseif (is_array($data[0])) {
                $this->viewData = array_merge($this->viewData, $data[0]);
            } else {
                return false;
            }
        }

        return true;
    }

    public function setDefaultData()
    {
        $this->fillMeta(config('seo'),'array');

        $this->data(['locales' => LocaleMiddleware::getNonCurrentLanguages()]);

        $this->data(['current_local' => LocaleMiddleware::getCurrentLanguage()]);
    }

    /**
     * @param $data
     * @param $type
     */
    public function fillMeta($data, $type)
    {
        if($type=='model') {
            Meta::title($data->title);
            Meta::_set('meta_title',$data->meta_title);
            Meta::_set('description',$data->description);
            Meta::_set('meta_description',$data->meta_description);
            Meta::_set('keywords',$data->keywords);
            if ($image = $data->image)
            {
                Meta::_set('image',url($image));
            }
        } elseif ($type=='array') {
            foreach ($data as $property => $val)
                Meta::_set($property,$val);
        }

        Meta::_set('locale', LocaleMiddleware::getCurrentLanguage());
        if( !app()->runningInConsole() ) Meta::_set('url',app(Request::class)->fullUrl());
    }
}
