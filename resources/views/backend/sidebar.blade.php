<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('assets/img/icons/logo-bartech.png') }}" style="display: block;  max-width: 100%; margin: auto; z-index: 10" alt="">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bxs-data'></i>
                <div data-i18n="Account Settings">Data Table</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('training.index') }}" class="menu-link">
                        <div data-i18n="Account">Training</div>
                    </a>
                </li>
            </ul>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('sertifikat.index') }}" class="menu-link">
                        <div data-i18n="Account">Sertifikat</div>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</aside>
<!-- / Menu -->
