@extends('backend.app')
@section('title','All Member')
@push('css')

@endpush
@section('main_menu','Member')
@section('active_menu','All Member')
@section('content')











@endsection
@push('js')
    @include('backend.member.all_member_js')
@endpush
