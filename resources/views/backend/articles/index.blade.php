@extends('backend.layouts.app')

@section('title', __('Article List'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Article List')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.articles.create')"
                    :text="__('Create Article')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.articles-table />
        </x-slot>
    </x-backend.card>
@endsection
