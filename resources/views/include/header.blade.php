<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown d-md-down-none">
            @if (auth()->check())
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-ghost-dark btn-block btn-hover">
                        ログアウト
                    </button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="btn btn-ghost-dark btn-block btn-hover">
                    ログインする
                </a>
            @endif
        </li>
    </ul>
</header>
