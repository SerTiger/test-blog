<div class="row box-footer @if (!empty($class)) {!! $class !!} @endif">
    <div class="col-md-6">
        <a href="{!! empty($back_url) ? route('admin.' . $module . '.index') : $back_url !!}" class="btn btn-flat btn-sm btn-default">@lang('labels.cancel') </a>
    </div>

    <div class="col-md-6 justify-content-end text-right">
        <input class="btn btn-success btn-flat button" type="submit" value="{{trans('labels.save')}}">

    </div>
</div>
