<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AjaxFieldsChangerTrait;
use App\Http\Requests\Backend\Tag\TagCreateRequest;
use App\Http\Requests\Backend\Tag\TagUpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    use AjaxFieldsChangerTrait;

    public $module = "tags";

    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_access'), 403);

        if ($request->get('draw')) {
            $list = Tag::joinTranslations()->with('categories')->select(
                'tags.id as id',
                'tags.status as status',
                'tag_translations.title as title',
                'tag_translations.description as description'
            );

            return $this->_datatable($list);
        }

        return view('admin.view.' . $this->module . '.index', ['module' => $this->module]);
    }

    public function edit(Tag $tag)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Tag::findOrFail($tag->id);

        $data['module'] = $this->module;

        $data['model'] = $model;

        $data['categories'] = Category::visible()->positionSorted()->get()->pluck('title', 'id');

        return view('admin.view.' . $this->module . '.edit', $data);
    }

    public function create()
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data['module'] = $this->module;

        $data['model'] = new Tag;

        $data['categories'] = Category::visible()->positionSorted()->get()->pluck('title', 'id');

        return view('admin.view.' . $this->module . '.create', $data);
    }

    public function store(TagCreateRequest $request)
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data = $request->except('_token');

        $tag = Tag::create($data);

        $tag->categories()->sync($request->input('categories', []));

        toastr()->success(__('admin_labels.success.create', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function update(TagUpdateRequest $request, Tag $tag)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Tag::findOrFail($tag->id);

        $data = $request->except('_method', '_token');

        $model->update($data);

        $model->categories()->sync($request->input('categories', []));

        toastr()->success(__('admin_labels.success.update', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function show(Tag $tag)
    {
        abort_unless(\Gate::allows($this->module . '_show'), 403);

        return $this->edit($tag);
    }

    public function destroy(Tag $tag)
    {
        abort_unless(\Gate::allows($this->module . '_delete'), 403);

        $tag->delete();

        toastr()->success(__('admin_labels.success.delete', ['model' => ucfirst($this->module)]));

        return back();
    }

    private function _datatable(Builder $list)
    {
        return $dataTables = DataTables::of($list)
            ->filterColumn(
                'id',
                function ($query, $keyword) {
                    $query->whereRaw("tags.id like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'title',
                function ($query, $keyword) {
                    $query->whereRaw("tag_translations.title like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'description',
                function ($query, $keyword) {
                    $query->whereRaw("tag_translations.description like ?", ["%{$keyword}%"]);
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
                        'datatables.control_buttons',
                        ['model' => $model, 'front_link' => true, 'type' => $this->module]
                    )->render();
                }
            )
            ->addColumn(
                'categories',
                function ($model) {
                    return view('admin.view.'.
                        $this->module.'.partials.list',
                        ['list' => $model->categories, 'type' => 'user']
                    )->render();
                })
            ->rawColumns(['status', 'actions', 'title', 'description', 'categories'])
            ->make();
    }
}
