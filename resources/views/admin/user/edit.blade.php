@extends('layouts.admin')

@section('content')
    <user-edit
        :route="{{ json_encode([
            'update' => route('user.update', $user->id),
            'index' => route('user.index'),
        ]) }}"
        :data="{{ json_encode([
            'listEmail' => isset($listEmail) ? $listEmail : [],
            'user' => isset($user) ? $user : [],
        ]) }}">
    </user-edit>
@endsection
