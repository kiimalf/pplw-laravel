<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
<!--begin::Sidebar Brand-->
<div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
    <!--begin::Brand Image-->
    <img
        src={{ asset('assets/img/AdminLTELogo.png') }}
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
    />
    <!--end::Brand Image-->
    <!--begin::Brand Text-->
    <span class="brand-text fw-light">RSHP</span>
    <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
</div>
<!--end::Sidebar Brand-->
<!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
    <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false" id="navigation">
            <li class="nav-item ">
                <a href={{ route('admin.dashboard') }} class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-speedometer"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @php
                $aksesDataMaster =
                request()->routeIs ('admin.user.*') ||
                request()->routeIs ('admin.role.*') ||
                request()->routeIs ('admin.role-user.*') ||
                request()->routeIs ('admin.jenis-hewan.*') ||
                request()->routeIs ('admin.ras-hewan.*') ||
                request()->routeIs ('admin.pemilik.*') ||
                request()->routeIs ('admin.pet.*');
            @endphp
            <li class="nav-item {{ $aksesDataMaster ? 'menu-open' : '' }}">
                <a  class="nav-link {{ $aksesDataMaster ? 'active' : '' }}">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>
                    Data Master
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview style="{{ $aksesDataMaster ? 'display:block;' : '' }}">
                    <li class="nav-item">
                        <a href={{ route('admin.user.index') }} class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.role.index') }} class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Role</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.role-user.index') }} class="nav-link {{ request()->routeIs('admin.role-user.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Role User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.jenis-hewan.index') }} class="nav-link {{ request()->routeIs('admin.jenis-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Jenis Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.ras-hewan.index') }} class="nav-link {{ request()->routeIs('admin.ras-hewan.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Ras Hewan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.pemilik.index') }} class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Pemilik</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.pet.index') }} class="nav-link {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Pet</p>
                        </a>
                    </li>
                </ul>
            </li>
            @php
                $aksesRekamMedis =
                    request()->routeIs ('admin.kategori.*') ||
                    request()->routeIs ('admin.kategori-klinis.*') ||
                    request()->routeIs ('admin.tindakan-terapi.*') ||
                    request()->routeIs ('admin.temu-dokter.*') ||
                    request()->routeIs ('admin.rekam-medis.*') ||
                    request()->routeIs ('admin.detail-rekam-medis.*');
            @endphp
            <li class="nav-item {{ $aksesRekamMedis ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $aksesRekamMedis ? 'active' : '' }}">
                    <i class="nav-icon bi bi-clipboard-fill"></i>
                    <p>
                    Rekam Medis
                    <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview style="{{ $aksesRekamMedis ? 'display:block;' : '' }}">
                    <li class="nav-item">
                        <a href={{ route('admin.kategori.index') }} class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.kategori-klinis.index') }} class="nav-link {{ request()->routeIs('admin.kategori-klinis.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Kategori Klinis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.tindakan-terapi.index') }} class="nav-link {{ request()->routeIs('admin.tindakan-terapi.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Tindakan & Terapi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.temu-dokter.index') }} class="nav-link {{ request()->routeIs('admin.temu-dokter.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Temu Dokter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('admin.rekam-medis.index') }} class="nav-link {{ request()->routeIs('admin.rekam-medis.*') || request()->routeIs('admin.detail-rekam-medis.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-header">DOCUMENTATIONS</li>
            
        </ul>
    <!--end::Sidebar Menu-->
    </nav>
</div>
<!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->