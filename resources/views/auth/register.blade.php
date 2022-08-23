@extends('layouts.authUser')

@section('content')
    <register-user :route="{{ json_encode([
        'verify' => route('verifyRemind'),
        'urlRegister' => url('/register'),
    ]) }}"
        :data="{{ json_encode([
            'listEmail' => isset($listEmail) ? $listEmail : [],
        ]) }}">
    </register-user>
@endsection

@section('javascript')
@endsection
