@extends('layouts.authUser')

@section('content')
<login-user
:route="{{ json_encode([
    'urlHome' => route('top'),
    'urlLogin' => url('/login'),
]) }}">
</login-user>
@endsection
