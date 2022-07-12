@extends('adminlte::page')

@section('content')

    <div class="card">
        <div class="card-header">
           Просмотр прав доступа
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>
                     Название
                    </th>
                    <td>
                        {{ $model->title }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.permissions.index') }}">
                {{__('admin/buttons.back')}}
            </a>
        </div>
    </div>

@endsection
