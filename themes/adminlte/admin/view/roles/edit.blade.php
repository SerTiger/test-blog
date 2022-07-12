@extends('adminlte::page')
@section('content')

<div class="card">
    <div class="card-header">
        {{__('admin/roles.edit_role')}}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{__('admin/roles.fields.title')}}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block" style="color: red;">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{__('admin/roles.fields.title')}}
                </p>
            </div>
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permissions">{{__('admin/roles.fields.permissions')}}*
                    <span class="btn btn-info btn-xs select-all">Select all</span>
                    <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                            {{ $permissions }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <p class="help-block">
                        {{ $errors->first('permissions') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{__('admin/roles.fields.permissions')}}
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
        <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}">
            {{__('admin/buttons.back')}}
        </a>
    </div>
</div>
@endsection
@extends('admin.partials.style')
