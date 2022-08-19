<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AjaxFieldsChangerTrait;
use App\Models\Category;
use App\Models\Pool;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PoolController extends Controller
{
    use AjaxFieldsChangerTrait;

    public $module = "pools";

    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_access'), 403);

        if ($request->get('draw')) {
            $list = Pool::joinTranslations()->select(
                'pools.id as id',
                'pools.status as status',
                'pools.position as position',
                'pools.owner_id as owner_id',
                'pools.network as network',
                'pools.date_start',
                'pools.date_end',
                'pool_translations.title as title',
                'pool_translations.description as description'
            );

            return $this->_datatable($list);
        }

        return view('admin.view.' . $this->module . '.index', ['module' => $this->module]);
    }

    public function edit(Pool $category)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Pool::findOrFail($category->id);

        $data['module'] = $this->module;

        $data['model'] = $model;

        $data = $this->fillDefaultData($data);

        return view('admin.view.' . $this->module . '.edit', $data);
    }

    public function create()
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data['module'] = $this->module;

        $data['model'] = new Pool;

        $data = $this->fillDefaultData($data);

        return view('admin.view.' . $this->module . '.create', $data);
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data = $request->except('_token');

        Pool::create($data);

        toastr()->success(__('admin_labels.success.create', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function update(Request $request, Pool $category)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $model = Pool::findOrFail($category->id);

        $data = $request->except('_method', '_token');

        $model->update($data);

        toastr()->success(__('admin_labels.success.update', ['model' => ucfirst($this->module)]));

        return redirect()->route('admin.' . $this->module . '.index');
    }

    public function show(Pool $category)
    {
        abort_unless(\Gate::allows($this->module . '_show'), 403);

        return $this->edit($category);
    }

    public function destroy(Pool $category)
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
                    $query->whereRaw("pools.id like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'title',
                function ($query, $keyword) {
                    $query->whereRaw("pool_translations.title like ?", ["%{$keyword}%"]);
                })
            ->filterColumn(
                'description',
                function ($query, $keyword) {
                    $query->whereRaw("pool_translations.description like ?", ["%{$keyword}%"]);
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
            ->editColumn(
                'owner',
                function ($model) {
                    return $model->owner->name;
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

    private function fillDefaultData($data)
    {
        $data['module'] = $this->module;

        $data['tags'] = Tag::all()->pluck('title', 'id');

        $data['categories'] = Category::all()->pluck('title', 'id');

        $data['users'] = User::whereHas('roles',function($q) {
            return $q->where('roles.title','=','User');
        })->pluck('name', 'id');

        $data['languages'] = [];
        foreach (config('translatable.locales') as $language)  {
            $data['languages'][$language] = __('admin_labels.tab_'.$language);
        }

        return $data;
    }
}
