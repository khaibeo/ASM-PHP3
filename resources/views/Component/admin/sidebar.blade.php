<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Trang chủ</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCatalogue" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCatalogue">
                        <i class="ri-layout-3-line"></i> <span data-key="t-apps">Danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatalogue">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.add') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">
                                    Thêm mới
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.index') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarInvoices" data-key="t-invoices">
                                    Danh sách
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProduct">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.add') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">
                                    Thêm mới
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.products.variant') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarInvoices" data-key="t-invoices">
                                    Thuộc tính
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarInvoices" data-key="t-invoices">
                                    Danh sách
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Người dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.add') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin"> Thêm mới
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link" role="button" aria-expanded="false" aria-controls="sidebarSignUp" data-key="t-signup"> Danh sách
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                        <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Mã giảm giá</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.add') }}" class="nav-link" data-key="t-sweet-alerts">Thêm mới</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.vouchers.index') }}" class="nav-link" data-key="t-nestable-list">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.orders.index')}}" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-pages-line"></i> <span data-key="t-pages">Đơn hàng</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.banners.index')}}">
                        <i class="ri-honour-line"></i> <span data-key="t-widgets">Banner</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.invoices.index')}}" role="button" aria-expanded="false" aria-controls="sidebarForms">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Hóa đơn</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>