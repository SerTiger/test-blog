<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AjaxFieldsChangerTrait;
use App\Http\Requests\Backend\Category\CategoryUpdateRequest;
use App\Http\Requests\Backend\Category\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use AjaxFieldsChangerTrait;

    public $module = "categories";

    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_access'), 403);

        if ($request->get('draw')) {
            $list = Category::joinTranslations()->select(
                'categories.id as id',
                'categories.slug as slug',
                'categories.status as status',
                'categories.position as position',
                'category_translations.title as title',
                'category_translations.description as description'
            );

            return $this->_datatable($list);
        }

        return view('admin.view.' . $this->module . '.index', ['module' => $this->module]);
    }

    public function edit(Category $category)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Category::findOrFail($category->id);

        $data['module'] = $this->module;

        $data['model'] = $model;

        return view('admin.view.' . $this->module . '.edit', $data);
    }

    public function create()
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data['module'] = $this->module;

        $data['model'] = new Category;

        return view('admin.view.' . $this->module . '.create', $data);
    }

    public function store(CategoryCreateRequest $request)
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data = $request->except('_token');

        Category::create($data);

        toastr()->success(__('admin_labels.success.create', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Category::findOrFail($category->id);

        $data = $request->except('_method', '_token');

        $model->update($data);

        toastr()->success(__('admin_labels.success.update', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function show(Category $category)
    {
        abort_unless(\Gate::allows($this->module . '_show'), 403);

        return $this->edit($category);
    }

    public function destroy(Category $category)
    {
        abort_unless(\Gate::allows($this->module . '_delete'), 403);

        $category->delete();

        toastr()->success(__('admin_labels.success.delete', ['model' => ucfirst($this->module)]));

        return back();
    }

    private function _datatable(Builder $list)
    {
        return $dataTables = DataTables::of($list)
            ->filterColumn(
                'id',
                function ($query, $keyword) {
                    $query->whereRaw("categories.id like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'title',
                function ($query, $keyword) {
                    $query->whereRaw("category_translations.title like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'description',
                function ($query, $keyword) {
                    $query->whereRaw("category_translations.description like ?", ["%{$keyword}%"]);
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
            ->rawColumns(['status', 'actions', 'title', 'description'])
            ->make();
    }
}
