@extends('layouts.admin')

@section('content')
    <user-create
        :route="{{ json_encode([
            'register' => route('user.store'),
            'index' => route('user.index'),
        ]) }}"
        :data="{{ json_encode([
            'listEmail' => isset($listEmail) ? $listEmail : []
        ]) }}">
    </user-create>
@endsection
