@extends('admin.layouts.listable')
@section('content_header')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.'.$module.'.create') }}">
                {{__('admin_labels.add_pool')}}
            </a>
        </div>
    </div>

@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="pages-table">
                        {!!
                            TablesBuilder::create(
                                ['id' => "datatable1", 'class' => "table table-bordered table-striped table-hover w-100"]
                            )->addHead([
                                    ['text' => trans('admin_labels.id')],
                                    ['text' => trans('admin_labels.title')],
                                    ['text' => trans('admin_labels.status')],
                                    ['text' => trans('admin_labels.date_start')],
                                    ['text' => trans('admin_labels.date_end')],
                                    ['text' => trans('admin_labels.position')],
                                    ['text' => trans('admin_labels.actions')],
                                ])
                                ->addFoot([
                                    ['attr' => ['colspan' => 7]]
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
                                ['id' => "datatable1", 'class' => "table table-bordered table-striped table-hover w-100"],

                                [
                                    'bStateSave' => true,
                                    'order' => [[ 4, 'asc' ]],
                                    "columns" => [
                                        [ "data" => "id" ],
                                        [ "data" => "title"],
                                        [ "data" => "status" ],
                                        [ "data" => "date_start" ],
                                        [ "data" => "date_end" ],
                                        [ "data" => "position" ],
                                        [ "data" => "actions" ],
                                    ],
                                ]
                            )
                             ->makejs()
                        !!}

@endsection
