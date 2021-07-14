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
            <bread-crumb :title="`Hello {{ auth()->user()->name }}!`" :items="[
                {
                    title: 'Dashboard',
                    current: true
                }
            ]"></bread-crumb>
            <loader :show="true"></loader>
            <dashboard>
            </dashboard>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
