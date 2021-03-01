@extends('backend.layouts.app')

@section('title', __('Edit Articles'))

@push('after-styles')

@endpush
@section('content')
    <x-forms.patch :action="route('admin.articles.update', $article)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Edit Articles ')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.articles.list')" :text="__('Cancel')"/>
            </x-slot>

            <x-slot name="body">
                <div class="pb-5">
                    @include('backend.articles.includes.form')
                </div>

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
            </x-slot>

        </x-backend.card>
    </x-forms.patch>

    @push('after-scripts')
        @include('backend.articles.includes.form_js')
    @endpush
@endsection
