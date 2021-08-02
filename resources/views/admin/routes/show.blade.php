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
            <bread-crumb :title="`{{ $route->board_point.'-'.$route->drop_point }}`" :items="[
                {
                    title: 'Home',
                    url: '{{ route('admin.home') }}'
                },
                {
                    title: 'Routes',
                    url: '{{ route('admin.routes.index') }}'
                },
                {
                    title: 'Route View',
                    current: true
                }
            ]"></bread-crumb>
            <route-view :route="{{ $route }}"></route-view>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
