<ul class="menu">
    <li class="sidebar-title">Menu Basic</li>

    <li class="sidebar-item {{ Route::is('manager.dashboard', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.dashboard') }}" class='sidebar-link'>
            <i class="fa-solid fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item {{ Route::is('manager.profile.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.profile.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-user-edit"></i>
            <span>Edit Profile</span>
        </a>
    </li>

    <li class="sidebar-item {{ Route::is('manager.manage-connect.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.manage-connect.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-message"></i>
            <span>iConnect</span>
        </a>
    </li>

    <li class="sidebar-title">Menu Advanced</li>

    <li class="sidebar-item {{ Route::is('manager.manage-page.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.manage-page.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-folder"></i>
            <span>Kelola Halaman</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('manager.manage-balance.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.manage-balance.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-money-bill"></i>
            <span>Kelola Balance</span>
        </a>
    </li>
    <li class="sidebar-item {{ Route::is('manager.manage-email.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.manage-email.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-envelope"></i>
            <span>Kelola Email</span>
        </a>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('manager.manage-blog.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-blog"></i>
            <span>Kelola Blog</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('manager.manage-blog.tags-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-blog.tags-index') }}" class="submenu-link">Daftar Tags</a>
            </li>
            <li class="submenu-item  {{ Route::is('manager.manage-blog.category-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-blog.category-index') }}" class="submenu-link">Daftar Kategori</a>
            </li>
            <li class="submenu-item  {{ Route::is('manager.manage-blog.posts-*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-blog.posts-index') }}" class="submenu-link">Daftar Postingan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('manager.manage-booking.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Kelola Pesanan</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('manager.manage-booking.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-booking.index') }}" class="submenu-link">Daftar Pesanan</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('manager.manage-product.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Kelola Product</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('manager.manage-product.category.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-product.category.index') }}" class="submenu-link">Daftar Kategori Product</a>
            </li>
            <li class="submenu-item {{ Route::is('manager.manage-product.rating-*', request()->path()) || Route::is('manager.manage-product.edit', request()->path()) || Route::is('manager.manage-product.create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-product.rating-index') }}" class="submenu-link">Daftar Rating Product</a>
            </li>
            <li class="submenu-item {{ Route::is('manager.manage-product.index', request()->path()) || Route::is('manager.manage-product.edit', request()->path()) || Route::is('manager.manage-product.create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-product.index') }}" class="submenu-link">Daftar Product</a>
            </li>
            <li class="submenu-item {{ Route::is('manager.manage-product.portofolio-index', request()->path()) || Route::is('manager.manage-product.portofolio-edit', request()->path()) || Route::is('manager.manage-product.portofolio-create', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-product.portofolio-index') }}" class="submenu-link">Daftar Portofolio</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub {{ Route::is('manager.manage-member.*', request()->path()) || Route::is('manager.manage-admin.*', request()->path()) ? 'active' : '' }}">
        <a href="#" class='sidebar-link'>
            <i class="fa-solid fa-users"></i>
            <span>Kelola Pengguna</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item  {{ Route::is('manager.manage-member.*', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-member.index') }}" class="submenu-link">Daftar Member</a>
            </li>
            <li class="submenu-item {{ Route::is('manager.manage-admin.index', request()->path()) ? 'active' : '' }}">
                <a href="{{ route('manager.manage-admin.index') }}" class="submenu-link">Daftar Admin</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Route::is('manager.manage-web.index.*', request()->path()) ? 'active' : '' }}">
        <a href="{{ route('manager.manage-web.index') }}" class='sidebar-link'>
            <i class="fa-solid fa-gear"></i>
            <span>Pengaturan Website</span>
        </a>
    </li>

</ul>
