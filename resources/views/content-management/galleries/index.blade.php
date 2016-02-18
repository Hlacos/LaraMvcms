@extends('lara-mvcms::layouts.application')

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="row">
                <div class="col-sm-1">
                    <form action="{{ route('lara-mvcms.content-management.galleries.index', ['parent_id' => $parentId]) }}" method="get" id="pager-form">
                        <input type="hidden" name="grid" value="{{ $gridView ? 1 : 0 }}">

                        <select name="size">
                            <option value="5" {{ request('size') && request('size') == "5" ? "selected" : "" }}>5</option>
                            <option value="25" {{ !request('size') || request('size') == "25" ? "selected" : "" }}>25</option>
                            <option value="50" {{ request('size') && request('size') == "50" ? "selected" : "" }}>50</option>
                            <option value="100" {{ request('size') && request('size') == "100" ? "selected" : "" }}>100</option>
                        </select>
                    </form>
                </div>
                <div class="col-sm-5">
                    <form action="{{ route('lara-mvcms.content-management.galleries.index', ['parent_id' => $parentId]) }}" method="get" id="gridview-form">
                        <input type="hidden" name="size" value="{{ request('size') ?: 25 }}">
                        <div class="btn-group">
                            <button type="submit" name="grid" value="0" class="btn btn-sm btn-default{{ $gridView ? "" : " active" }}"><span class="glyphicon glyphicon-list"></span></button>
                            <button type="submit" name="grid" value="1" class="btn btn-sm btn-default{{ $gridView ? " active" : "" }}"><span class="glyphicon glyphicon-th"></span></button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="btn-group pull-right">
                        <a class="btn btn-flat btn-primary right" href="{{ route('lara-mvcms.content-management.galleries.create', ['parent_id' => $parentId, 'is_directory' => 0]) }}">
                            {{ trans('lara-mvcms::galleries.buttons.create-file') }} <i class="fa fa-file-image-o"></i>
                        </a>
                        <a class="btn btn-flat btn-info right" href="{{ route('lara-mvcms.content-management.galleries.create', ['parent_id' => $parentId, 'is_directory' => 1]) }}">
                            {{ trans('lara-mvcms::galleries.buttons.create-directory') }} <i class="fa fa-folder"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @foreach ($ancestors as $ancestor)
                        <a href="{{ route('lara-mvcms.content-management.galleries.index', ['parent_id' => $currentGallery->parent_id, 'size' => request('size') ?: 25, 'grid' => $gridView ? 1 : 0]) }}">{{ $ancestor->title }}</a> /
                    @endforeach
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            @if ($gridView)
                @include('lara-mvcms::content-management.galleries._grid', ['galleries' => $galleries])
            @else
                @include('lara-mvcms::content-management.galleries._table', ['galleries' => $galleries])
            @endif
        </div><!-- /.box-body -->
        <div class="box-footer">
            @include('lara-mvcms::partials._pager', ['items' => $galleries])
        </div>
    </div>
@stop

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::galleries.title') }}
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</a>
        </li>
        <li class="active"><i class="fa fa-file"></i> {{ trans('lara-mvcms::galleries.title') }}</li>
    </ol>
@overwrite
