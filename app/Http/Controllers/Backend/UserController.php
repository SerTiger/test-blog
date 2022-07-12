<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Http\Requests\Backend\UserCreateRequest;
use App\Http\Requests\Backend\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $module = "user";

    public function index(Request $request)
    {
        abort_unless(\Gate::allows($this->module . '_access'), 403);

        if ($request->get('draw')) {
            $list = User::with('roles')->select(
                [
                    'id',
                    'email'
                ]
            );

            return $this->_datatable($list);
        }

        return view('admin.view.'.$this->module .'.index');
    }

    public function create()
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.view.'.$this->module .'.create', compact('roles'));
    }

    public function store(UserCreateRequest $request)
    {
        abort_unless(\Gate::allows($this->module . '_create'), 403);

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);

        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.'.$this->module .'.index');
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.view.'.$this->module .'.edit', compact('roles', 'user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        abort_unless(\Gate::allows($this->module . '_edit'), 403);

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.'.$this->module .'.index');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows($this->module . '_show'), 403);

        $user->load('roles');

        return view('admin.view.'.$this->module .'.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows($this->module . '_delete'), 403);

        $user->delete();

        return back();
    }

    private function _datatable(Builder $list)
    {
            $roles = $list->get();
            return $dataTables = DataTables::of($list)
                ->filterColumn(
                    'actions',
                    function ($query, $keyword) {
                        $query->whereRaw('users.id like ?', ['%'.$keyword.'%']);
                    }
                )
                ->addColumn(
                    'actions',
                    function ($model) {
                        return view('admin.view.'.
                            $this->module.'.partials.control_buttons',
                            ['model' => $model, 'type' => 'user', 'without_delete' => false]
                        )->render();
                    }
                )
                ->addColumn(
                    'roles_id',
                    function ($roles) {
                        return view('admin.view.'.
                            $this->module.'.partials.roles',
                            ['list' => $roles,'type' => 'user']
                        )->render();
                    }
                )
                ->rawColumns(['actions','roles_id'])
                ->make();
    }
}
