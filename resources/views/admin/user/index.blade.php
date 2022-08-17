@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <page-size :page-limit="{{ $pageLimit }}"></page-size>
                            </div>
                            <div class="col-md-10">
                                <input-search :page-limit="{{ $pageLimit }}"
                                    :url="{{ json_encode(route('admin.user.index')) }}"
                                    :data-query="{{ json_encode(!empty($request) ? $request->all() : new stdClass()) }}">
                                </input-search>
                            </div>
                        </div>
                        @if (!$users->isEmpty())
                            <div class="tanemaki-table">
                                <table class="table table-responsive-sm table-striped border">
                                    <thead>
                                        <tr>
                                            <th class="text-left">icon</th>
                                            <th class="text-left">@sortablelink('name', 'name')</th>
                                            <th class="text-left">@sortablelink('email', 'email')</th>
                                            <th class="text-left">@sortablelink('birth_date', 'birth date')</th>
                                            <th class="text-left">@sortablelink('gender', 'gender')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="text-left">
                                                    <img class="icon-user" src="{{ $user->icon }}" alt="">
                                                </td>
                                                <td class="text-left">{{ $user->name }}</td>
                                                <td class="text-left">{{ $user->email }}</td>
                                                <td class="text-left">{{ $user->birth_date }}</td>
                                                <td class="text-left">{{ $user->gender }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $users->appends(\Request::except('page'))->render() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
