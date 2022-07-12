@extends('adminlte::page')
@section('content')

<div class="card">
    <div class="card-header">
       Просмотр Роли
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                      Название
                    </th>
                    <td>
                        {{ $role->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Права доступа
                    </th>
                    <td>
                        @foreach($role->permissions as $id => $permissions)
                            <span class="badge badge-info">{{ $permissions->title }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ request()->headers->get('referer') ? request()->headers->get('referer') :route('admin.roles.index') }}">
                    {{__('admin/buttons.back')}}
                </a>
            </div>
        </div>

    </div>
</div>

@endsection
