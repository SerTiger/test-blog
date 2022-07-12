@can($type.'_show')
    <a class="btn btn-xs btn-primary" href="{{$type .'/'. $model->id}}">
        Просмотр
    </a>
@endcan
@can($type.'_edit')
    <a class="btn btn-xs btn-info" href="{{$type .'/'. $model->id . '/edit'}}">
        Редактировать
    </a>
@endcan