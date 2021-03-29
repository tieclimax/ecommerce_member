<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src={{ asset('images/icons/ecommerce.png') }} style="width: 40px" alt="">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
        </div>
        <div class="sidebar-brand-text mx-3">TopShop</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>แดชบอร์ด</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ร้านค้า
    </div>
    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.order.index') }}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>คำสั่งซื้อ</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.productreview.index') }}">
            <i class="fas fa-comments"></i>
            <span>รีวิว</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        โพส
    </div>
    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.post-comment.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span> ความคิดเห็น </span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
