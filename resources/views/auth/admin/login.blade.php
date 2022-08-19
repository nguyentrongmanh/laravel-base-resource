@extends('layouts.auth')

@section('content')
<login
:route="{{ json_encode([
    'urlAdminHome' => route('admin.dashboard'),
    'urlAdminLogin' => route('adminLoginPost'),
]) }}"
>
</login>
@endsection
