@extends('lara-mvcms::layouts.application')

@section('content')
    @include('lara-mvcms::content-management.pages._form')
@stop

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::pages.create-title') }}
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</a>
        </li>
        <li>
            <a href="{{ route('lara-mvcms.content-management.pages.index') }}"><i class="fa fa-file"></i> {{ trans('lara-mvcms::pages.title') }}</a>
        </li>
        <li class="active"> {{ trans('lara-mvcms::pages.create-title') }}</li>
    </ol>
@overwrite
