<div class="row justify-content-between">
    <div class="col-md-6 text-left">
        <a href="{!! route('admin.translation.index', $group) !!}"
           class="btn btn-flat btn-secondary">{{__('admin/buttons.cancel')}} </a>
    </div>


    <div class="col-md-6 text-right">
        <button class="btn btn-success btn-flat with-loading" onclick="myAlertTop()" type="button">{{__('admin/buttons.save')}}</button>
    </div>
</div>
