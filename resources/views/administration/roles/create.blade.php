@extends('lara-mvcms::layouts.application')

@section('content')
    @include('lara-mvcms::administration.roles._form')
@stop

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::roles.create-title') }}
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('lara-mvcms.dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</a>
        </li>
        <li>
            <a href="{{ route('lara-mvcms.administration.roles.index') }}"><i class="fa fa-group"></i> {{ trans('lara-mvcms::roles.title') }}</a>
        </li>
        <li class="active"> {{ trans('lara-mvcms::roles.create-title') }}</li>
    </ol>
@overwrite
