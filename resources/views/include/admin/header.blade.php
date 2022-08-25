<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav ml-auto mr-6">
        <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                <svg class="c-icon" style="width:20px;height:20px;">
                    <use xlink:href="{{ url('/icons/sprites/free.svg#cil-bell') }}"></use>
                </svg></a></li>
        <li class="vertical"></li>
        <li class="c-header-nav-item dropdown d-md-down-none">
            <form action="{{ url('/admin/logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-ghost-dark btn-block btn-hover">
                    <svg class="c-icon mr-1" style="width: 14px;height:14px;">
                        <use xlink:href="{{ url('/icons/sprites/free.svg#cil-account-logout') }}"></use>
                    </svg>
                    ログアウト
                </button>
            </form>
        </li>
    </ul>
    @if (isset($breadcrumbs))
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                @foreach ($breadcrumbs as $key => $breadcrumb)
                    @if ($key != count($breadcrumbs) - 1)
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item active"><span>{{ $breadcrumb }}</span></li>
                    @endif
                @endforeach
            </ol>
        </div>
    @endif
</header>
