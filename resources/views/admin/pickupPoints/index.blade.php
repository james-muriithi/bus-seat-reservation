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
            <bread-crumb title="Pickup Points" :items="[
                {
                    title: 'Home',
                    url: '{{ route('admin.home') }}'
                },
                {
                    title: 'Pickup Points',
                    current: true
                }
            ]"></bread-crumb>
            <pickup-point-index></pickup-point-index>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
