<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?mod=home&action=index" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Autosmart</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/img/admin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="?mod=users&action=main" class="d-block"><?php echo info_login()  ?></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Quản lý</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý trang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=page&action=list_page" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách trang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=page&action=add_page" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm trang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý bài viết
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=post&action=list_post" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=post&action=add_post" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý đơn vị vận chuyển
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=shipping&action=list_shipping" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách đơn vị vận chuyển</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=post&action=add_post" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm đơn vận chuyển</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý menu
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=menu&action=list_menu" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=menu&action=add_menu" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới menu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý slider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=slider&action=list_slider" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=slider&action=add_slider" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới slider</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý quảng cáo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=ads&action=list_ads" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách quảng cáo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=ads&action=add_ads" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới quảng cáo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý thông tin trang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=setting&action=main" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chỉnh sửa thông tin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quản lý khuyễn mãi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=promotion&action=list_promotion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách khuyễn mãi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=promotion&action=add_promotion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới khuyễn mãi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Hàng hóa</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=product&action=list_product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=product&action=add_product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới sản phẩm</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Quản lý danh mục
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?mod=category&action=list_cat" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?mod=category&action=add_cat" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Kinh doanh</li>
                <li class="nav-item">
                    <a href="?mod=sales&action=list_order" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Quản lý đơn hàng
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?mod=customer&action=list_customer" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Danh sách khách hàng
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">Tổng quát</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Thống kê
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê về khách hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/profile.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê về sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/e-commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thông kê về doanh thu</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>