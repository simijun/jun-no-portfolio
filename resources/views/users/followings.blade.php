@extends('layouts.app')

@section('content')
    {{-- ユーザ情報 --}}
    @include('users.card')
    <div class="d-flex justify-content-center">
        <div class="col-sm">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- ユーザ一覧 --}}
            @include('users.users')
        </div>
    </div>
@endsection