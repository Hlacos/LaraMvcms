@extends('lara-mvcms::layouts.application')

@section('content')
    @if (config('larave-analitycs.siteId'))
        {{ LaravelAnalytics::getVisitorsAndPageViews(7) }}
    @endif
@endsection

@section('page-header')
    <h1>
        {{ trans('lara-mvcms::dashboard.title') }}
        <small>{{ trans('lara-mvcms::dashboard.subtitle') }}</small>
    </h1>
@overwrite

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> {{ trans('lara-mvcms::dashboard.title') }}</li>
    </ol>
@overwrite
