@extends('adminlte::page')

@section('content')

<div class="card">
    <div class="card-header">
        {{__('admin/permissions.add_permission')}}
    </div>

    <div class="card-body">
        <form action="{{route('admin.permissions.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{__('admin/permissions.fields.title')}}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block" style="color: red;">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{__('admin/permissions.fields.title')}}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{__('admin/buttons.save')}}">
            </div>
        </form>
    </div>
</div>
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-secondary" href="{{ route('admin.permissions.index') }}">
            {{__('admin/buttons.back')}}
        </a>
    </div>
</div>
@endsection
