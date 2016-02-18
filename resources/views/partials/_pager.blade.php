<div class="row paginate">
    <div class="col-sm-6">
        {{ $items->currentPage() }} / {{ $items->lastPage() }} | {{ trans('lara-mvcms::pager.all-rows') }}: {{ $items->total() }}
    </div>
    <div class="dataTables_paginate paging_bootstrap col-sm-6 text-right">
        {!! $items->appends(request()->all())->render() !!}
    </div>
</div>
