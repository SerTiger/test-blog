@extends('adminlte::page')

@section('content_header')
    @can('roles_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.roles.create') }}">
                    Добавить роль
                </a>
            </div>
        </div>
    @endcan
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="groups-table">
                        {!!
                            TablesBuilder::create(
                                ['id' => "datatable1", 'class' => "table table-bordered table-striped table-hover"],
                                [
                                    'bStateSave' => true,
                                    'order' => [[ 0, 'desc' ]],
                                    "columns" => [
                                        [ "data" => "id" ],
                                        [ "data" => "title" ],
                                        [ "data" => "permission_id" ],
                                        [ "data" => "actions" ],
                                    ],
                                ]
                            )
                            ->addHead([
                                ['text' => trans('labels.id')],
                                ['text' => trans('labels.title')],
                                 ['text' =>'Права доступа'],
                                ['text' => trans('labels.actions')],
                            ])
                            ->addFoot([
                                ['attr' => ['colspan' => 2]]
                            ])
                            ->makehtml()
                        !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    {!!
                            TablesBuilder::create(
                                ['id' => "datatable1", 'class' => "table table-bordered table-striped table-hover"],
                                [
                                    'bStateSave' => true,
                                    'order' => [[ 0, 'desc' ]],
                                    "columns" => [
                                        [ "data" => "id" ],
                                        [ "data" => "title" ],
                                        [ "data" => "permission_id" ],
                                        [ "data" => "actions" ],
                                    ],
                                ]
                            )
                            ->addHead([
                                ['text' => trans('labels.id')],
                                ['text' => trans('labels.email')],
                                ['text' => trans('labels.email1')],
                                ['text' => trans('labels.actions')],
                            ])
                            ->addFoot([
                                ['attr' => ['colspan' => 4]]
                            ])
                            ->makejs()
                        !!}
@stop
