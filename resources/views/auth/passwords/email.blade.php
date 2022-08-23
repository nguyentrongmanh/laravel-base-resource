@extends('layouts.app')

@section('content')
<password-email
:route="{{ json_encode([
    'passwordEmail' => route('password.email'),
    'urlLogin' => url('/login'),
]) }}">
</password-email>
@endsection
