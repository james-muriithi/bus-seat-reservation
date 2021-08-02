@extends('layouts.app')
@section('styles')
    @parent

@endsection
@section('content')
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('partials.navbar')
        @include('partials.sidebar')
        <div class="page-wrapper">
            <bread-crumb title="Route Edit" :items="[
                {
                    title: 'Home',
                    url: '{{ route('admin.home') }}'
                },
                {
                    title: 'Routes',
                    url: '{{ route('admin.routes.index') }}'
                },
                {
                    title: 'Route Edit',
                    current: true
                }
            ]"></bread-crumb>
            <route-edit :route="{{ $route }}"></route-edit>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
