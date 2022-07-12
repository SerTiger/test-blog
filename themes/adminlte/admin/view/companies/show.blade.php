@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            {{trans('admin_labels.show_page')}}
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.view.' . $module . '.partials.show_form')
            </div>
        </div>
    </div>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ request()->headers->get('referer') ? request()->headers->get('referer') :route('admin.'.$module.'.index') }}">
                {{trans('admin_labels.back')}}
            </a>
        </div>
    </div>

@endsection
