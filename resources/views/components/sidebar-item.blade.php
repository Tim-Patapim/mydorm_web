<li class="sidebar-item {{ Str::startsWith(request()->path(), $page) ? 'active' : '' }}">
    <a class="sidebar-link" href="/{{ $page }}">
        <i class="align-middle" data-feather="{{ $icon }}"></i> <span
            class="align-middle">{{ $slot }}</span>
    </a>
</li>
