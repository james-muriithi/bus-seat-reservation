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
            <bread-crumb title="System Settings" :items="[
                {
                    title: 'Home',
                    url: '{{ route('admin.home') }}'
                },
                {
                    title: 'Settings',
                    url: '#'
                },
                {
                    title: 'System Settings',
                    current: true
                }
            ]"></bread-crumb>
            <?php
            $message = [];
            if (session()->has('success')) {
                $message['success'] = session()->get('success');
            } elseif (session()->has('error')) {
                $message['error'] = session()->get('error');
            }
            ?>
            <system-settings-index :session_message="{{ json_encode((object)$message) }}" :settings="{{ $systemSettings ?? '{}' }}"></system-settings-index>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
