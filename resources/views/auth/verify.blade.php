@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">あなたのメールアドレスを確認してください'</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新しい確認リンクがメール アドレスに送信されました。
                        </div>
                    @endif

                    続行する前に、メールで確認リンクを確認してください。
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
