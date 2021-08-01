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
            <bread-crumb title="Passenger Details" :items="[
                {
                    title: 'Home',
                    url: '{{ route('admin.home') }}'
                },
                {
                    title: 'Passengers',
                    url: '{{ route('admin.passengers.index') }}'
                },
                {
                    title: '{{ $passenger->name }}',
                    current: true
                }
            ]"></bread-crumb>
            <passenger-view :passenger="{{ $passenger }}"></passenger-view>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
