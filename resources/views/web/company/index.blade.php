@extends('web.layouts.app')
@section('title')
    {{ __('messages.company.company_listing') }}
@endsection
@section('page_css')
    @if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
        <style>
            .job-post-wrapper ul.pagination {
                direction: rtl;
            }
        </style>
    @endif
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('web.companies') }}</h2>
                </div>
            </div>
        </div>
    </section>

    @livewire('company-search', ['isFeatured' => Request::get('is_featured')])
@endsection
