<ul class="menu">
    {{-- DYNAMIC MENU --}}
    {{-- @php $pagemenu1 = App\Models\PageManager::where('page_type', 0)->where('page_role', $userlogin )->get(); @endphp --}}

    {{-- @foreach ($pagemenu1 as $item)
        <li class="sidebar-title">{{ $item->page_name }}</li>

        @php $pagelist1 = App\Models\PageManager::whereIn('page_type', [1, 2])->where('page_role', $userlogin )->where('page_id', $item->id)->get(); @endphp

        @foreach ($pagelist1 as $list)
        @php $smenu = App\Models\PageManager::where('page_type', 2)->where('page_role', $userlogin)->where('page_menu', $list->id)->get(); @endphp
            @if($list->page_type == 1)
            @php $isActive = $smenu->reduce(function ($carry, $sub) { return $carry || Str::is($sub->page_link.'*', request()->path()); }, false); @endphp
            <li class="sidebar-item {{ $smenu->count() == 0 ? '' : 'has-sub' }} {{ $isActive ? 'active' : '' }} {{ Str::is($list->page_link, request()->path()) ? 'active' : '' }}">
                <a href="{{ url($list->page_link) }}" class='sidebar-link'>
                    <i class="{{ $list->page_font }}"></i>
                    <span>{{ $list->page_name }}</span>
                </a>
                @if($smenu->count() >= 1)
                <ul class="submenu ">
                    @foreach ($smenu as $subitem)
                    <li class="submenu-item  {{ Str::is($subitem->page_link.'*', request()->path()) ? 'active' : '' }}">
                        <a href="{{ url($subitem->page_link) }}" class="submenu-link">{{ $subitem->page_name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
        @endforeach
    @endforeach --}}

    <li class="sidebar-title">Menu Basic</li>

    <li class="sidebar-item {{ Route::is('admin.dashboard', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
            <i class="fa-solid fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ Route::is('admin.profile.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.profile.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-user-edit"></i>
            <span>Edit Profile</span>
        </a>
    </li>

    <li class="sidebar-item {{ Route::is('admin.manage-connect.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.manage-connect.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-message"></i>
            <span>iConnect</span>
        </a>
    </li>

    <li class="sidebar-title">Menu Advanced</li>

    <li class="sidebar-item {{ Route::is('admin.manage-page.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.manage-page.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-folder"></i>
            <span>Kelola Halaman</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('admin.manage-balance.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.manage-balance.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-money-bill"></i>
            <span>Kelola Balance</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('admin.manage-email.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('admin.manage-email.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-envelope"></i>
            <span>Kelola Email</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('admin.manage-blog.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-blog"></i>
            <span>Kelola Blog</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('admin.manage-blog.tags-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-blog.tags-index') }}" class="submenu-link">Daftar Tags</a>
            </li>
            <li class="submenu-item  {{ Route::is('admin.manage-blog.category-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-blog.category-index') }}" class="submenu-link">Daftar Kategori</a>
            </li>
            <li class="submenu-item  {{ Route::is('admin.manage-blog.posts-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-blog.posts-index') }}" class="submenu-link">Daftar Postingan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('admin.manage-booking.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Kelola Pesanan</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('admin.manage-booking.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-booking.index') }}" class="submenu-link">Daftar Pesanan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('admin.manage-product.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Kelola Product</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('admin.manage-product.category.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-product.category.index') }}" class="submenu-link">Daftar Kategori Product</a>
            </li>
            <li class="submenu-item {{ Route::is('admin.manage-product.rating-*', request()->path()) || Route::is('admin.manage-product.edit', request()->path()) || Route::is('admin.manage-product.create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-product.rating-index') }}" class="submenu-link">Daftar Rating Product</a>
            </li>
            <li class="submenu-item {{ Route::is('admin.manage-product.index', request()->path()) || Route::is('admin.manage-product.edit', request()->path()) || Route::is('admin.manage-product.create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-product.index') }}" class="submenu-link">Daftar Product</a>
            </li>
            <li class="submenu-item {{ Route::is('admin.manage-product.portofolio-index', request()->path()) || Route::is('admin.manage-product.portofolio-edit', request()->path()) || Route::is('admin.manage-product.portofolio-create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-product.portofolio-index') }}" class="submenu-link">Daftar Portofolio</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('admin.manage-member.*', request()->path()) || Route::is('admin.manage-admin.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-users"></i>
            <span>Kelola Pengguna</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('admin.manage-member.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('admin.manage-member.index') }}" class="submenu-link">Daftar Member</a>
            </li>
        </ul>
    </li>

</ul>
