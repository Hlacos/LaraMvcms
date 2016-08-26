@extends('lara-mvcms::layouts.application')

@section('content')
    @include('lara-mvcms::administration.admin-users._form')
@stop

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::admin-users.create-title') }}
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</a>
        </li>
        <li>
            <a href="{{ route('lara-mvcms.administration.admin-users.index') }}"><i class="fa fa-user"></i> {{ trans('lara-mvcms::admin-users.title') }}</a>
        </li>
        <li class="active"> {{ trans('lara-mvcms::admin-users.create-title') }}</li>
    </ol>
@overwrite
