@extends('admin.layouts.editable')

@section('assets.top')
    @parent
    <script src="{!! asset('assets/components/sysTranslit/js/jquery.synctranslit.min.js') !!}"></script>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <form data-toggle="validator" action="{{ route("admin." . $module . ".update",$model->id) }}" method="POST" enctype="multipart/form-data" role = "form" style="padding: 0 15px">
            @csrf
            @method('PUT')
                @include('admin.view.' . $module . '.partials._form')

            </form>
        </div>
    </div>

@stop
