@extends('layouts.authUser')

@section('content')
<login-user
:route="{{ json_encode([
    'urlHome' => route('top'),
    'urlLogin' => url('/login'),
    'forgotPassword' => route('password.request'),
]) }}">
</login-user>
@endsection
