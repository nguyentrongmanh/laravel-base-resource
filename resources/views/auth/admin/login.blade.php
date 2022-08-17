@extends('layouts.auth')

@section('content')
<login
:route="{{ json_encode([
    'urlAdminHome' => route('admin.user.index'),
    'urlAdminLogin' => route('adminLoginPost'),
]) }}"
>
</login>
@endsection
