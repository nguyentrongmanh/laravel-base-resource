<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <img class="c-sidebar-brand-full" src="{{ url('/images/logo.svg') }}" width="118" height="46" alt="CoreUI Logo">
        <img class="c-sidebar-brand-minimized" src="{{ url('/images/logo.svg') }}" width="118" height="46" alt="CoreUI Logo">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.dashboard')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-speedometer"></use>
                </svg>
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('user.index')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-speedometer"></use>
                </svg>
                User list
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('admin.form')}}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-speedometer"></use>
                </svg>
                Form
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>

