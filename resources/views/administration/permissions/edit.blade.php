@extends('lara-mvcms::layouts.application')

@section('content')
    @include('lara-mvcms::administration.permissions._form')
@stop

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::permissions.edit-title') }}
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</a>
        </li>
        <li>
            <a href="{{ route('lara-mvcms.administration.permissions.index') }}"><i class="fa fa-lock"></i> {{ trans('lara-mvcms::permissions.title') }}</a>
        </li>
        <li class="active"> {{ trans('lara-mvcms::permissions.edit-title') }}</li>
    </ol>
@overwrite
