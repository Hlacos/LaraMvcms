@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('success') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        {{ session('info') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        {{ session('warning') }}
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger alert-dismissible">
        <button data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{ session('danger') }}
    </div>
@endif
