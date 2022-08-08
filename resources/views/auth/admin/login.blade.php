@extends('layouts.auth')

@section('content')
<login
:route="{{ json_encode([
    'urlAdminHome' => route('admin.home'),
    'urlAdminLogin' => route('adminLoginPost'),
]) }}"
>
</login>
@endsection
