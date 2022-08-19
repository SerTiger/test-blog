<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AjaxFieldsChangerTrait;
use App\Http\Requests\Backend\Page\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    use AjaxFieldsChangerTrait;

    public $module = "pages";

    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_access'), 403);

        if ($request->get('draw')) {
            $list = Page::joinTranslations()->select(
                'pages.id as id',
                'pages.slug as slug',
                'pages.status as status',
                'page_translations.title as title',
                'page_translations.description as description'
            );

            return $this->_datatable($list);
        }

        return view('admin.view.' . $this->module . '.index', ['module' => $this->module]);
    }

    public function edit(Page $page)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Page::findOrFail($page->id);

        $data['module'] = $this->module;

        $data['model'] = $model;

        return view('admin.view.' . $this->module . '.edit', $data);
    }

    public function update(PageUpdateRequest $request, Page $page)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Page::findOrFail($page->id);

        $data = $request->except('_method', '_token');

        $model->update($data);

        toastr()->success(__('admin_labels.success.update', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function show(Page $page)
    {
        abort_unless(\Gate::allows($this->module . '_show'), 403);

        return $this->edit($page);
    }

    public function destroy(Page $page)
    {
        abort_unless(\Gate::allows($this->module . '_delete'), 403);

        $page->delete();

        toastr()->success(__('admin_labels.success.delete', ['model' => ucfirst($this->module)]));

        return back();
    }

    private function _datatable(Builder $list)
    {
        return DataTables::of($list)
            ->filterColumn(
                'id',
                function ($query, $keyword) {
                    $query->whereRaw("pages.id like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'title',
                function ($query, $keyword) {
                    $query->whereRaw("page_translations.title like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'description',
                function ($query, $keyword) {
                    $query->whereRaw("page_translations.description like ?", ["%{$keyword}%"]);
                })
            ->editColumn(
                'description',
                function ($model) {
                    $description = strlen($model->description) > 100 ? substr($model->description, 0, 100) . ' ...' : $model->description;
                    return "{$description}";
                }
            )
            ->editColumn(
                'status',
                function ($model) {
                    return view(
                        'datatables.toggler',
                        ['model' => $model, 'type' => $this->module, 'field' => 'status']
                    )->render();
                }
            )
            ->addColumn(
                'actions',
                function ($model) {
                    return view(
                        'admin.view.'.$this->module.'.partials.control_buttons',
                        ['model' => $model, 'front_link' => true, 'type' => $this->module]
                    )->render();
                }
            )
            ->rawColumns(['status', 'actions', 'title', 'description'])
            ->make();
    }
}
