<div class="modal modal-{{ $status }}">
    <div class="modal-dialog">
        <form action="{{ isset($action) ? $action : 'javascript:void(0)' }}" method="{{ !isset($method) || $method == 'get' ? 'get' : 'post' }}">
            {{ csrf_field() }}
            @if (isset($method) && $method != 'get')
                <input type="hidden" name="_method" value="{{ $method }}" />
            @endif
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">{{ $title }}</h4>
                </div>
                <div class="modal-body">
                    @yield('modal-body')
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-outline pull-left" type="button">{{ $closeButtonTitle }}</button>
                    <button class="btn btn-outline" type="submit">{{ $okButtonTitle }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
