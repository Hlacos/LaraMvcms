@extends('lara-mvcms::partials._modal')

@section('modal-body')
    <p>
        @if ($isDirectory)
            {{ trans('lara-mvcms::galleries.delete-confirm-directory') }}
        @else
            {{ trans('lara-mvcms::galleries.delete-confirm-file') }}
        @endif
    </p>
@stop
