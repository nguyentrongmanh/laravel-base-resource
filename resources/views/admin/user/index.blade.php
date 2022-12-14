@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4 col-md-2">
                                <page-size :page-size="{{ json_encode(PAGE_SIZE_LIMIT) }}" :page-limit="{{ $pageLimit }}"></page-size>
                            </div>
                            <div class="col-8 col-md-4">
                                <input-search :page-limit="{{ $pageLimit }}"
                                    :url="{{ json_encode(route('user.index')) }}"
                                    :data-query="{{ json_encode(!empty($request) ? $request->all() : new stdClass()) }}">
                                </input-search>
                            </div>
                            <div class="col-12 col-md-4 mt-2 mt-md-0"></div>
                            <div class="col-10 col-md-2 d-md-flex justify-content-end">
                                <a class="btn btn-primary" href="{{ route('user.create') }}">ユーザーを作成</a>
                            </div>
                        </div>
                        @if (!$users->isEmpty())
                            <div class="tanemaki-table">
                                <table class="table table-responsive-sm table-striped border">
                                    <thead>
                                        <tr>
                                            <th class="text-left">アバター</th>
                                            <th class="text-left">@sortablelink('name', ' ユーザー名')</th>
                                            <th class="text-left">@sortablelink('email', ' Eメール')</th>
                                            <th class="text-left">@sortablelink('birth_date', ' 誕生日')</th>
                                            <th class="text-left">@sortablelink('gender', ' 性別')</th>
                                            <th class="text-left"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td class="text-left">
                                                    <img class="icon-user" src="{{ $user->media_image }}" alt="">
                                                </td>
                                                <td class="text-left">{{ $user->name }}</td>
                                                <td class="text-left">{{ $user->email }}</td>
                                                <td class="text-left">{{ $user->birth_date }}</td>
                                                <td class="text-left">{{ $user->gender }}</td>
                                                <td class="text-left">
                                                    <div class="btn-group">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">アクション</button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="fa-thin fa-pen-to-square"></i>編集</a>
                                                            </li>
                                                            <li>
                                                                <delete-item
                                                                    :delete-action="{{ json_encode(route('user.destroy', $user->id)) }}"
                                                                    :message-confirm="{{ json_encode('消去してもよろしいですか？') }}"
                                                                >
                                                                </delete-item>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
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
