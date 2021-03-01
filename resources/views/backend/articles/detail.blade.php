@extends('backend.layouts.app')

@section('title', __('Article View'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Article View')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.articles.list')" :text="__('Back')"/>
        </x-slot>
        <x-slot name="body">
            @include('backend.articles.includes.view')
        </x-slot>
    </x-backend.card>
@endsection
