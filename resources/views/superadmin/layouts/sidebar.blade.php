<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('superadmin') }}">
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
        <a class="nav-link" href="{{ route('superadmin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>แดชบอร์ด</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        จัดการ
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmin.file-manager') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>ผู้จัดการสื่อ</span></a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadminreview.index') }}">
            <i class="fas fa-comments"></i>
            <span>บทวิจารณ์</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ตั้งค่า
    </div>

    <!-- Posts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true"
            aria-controls="postCollapse">
            <i class="fas fa-fw fa-folder"></i>
            <span>กระทู้</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกกระทู้:</h6>
                <a class="collapse-item" href="{{ route('superadminpost.index') }}">กระทู้</a>
                <a class="collapse-item" href="{{ route('superadminpost.create') }}">เพิ่มกระทู้</a>
            </div>
        </div>
    </li>

    <!-- Category -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse"
            aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>หมวดหมู่</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกหมวดหมู่:</h6>
                <a class="collapse-item" href="{{ route('superadminpost-category.index') }}">หมวดหมู่</a>
                <a class="collapse-item" href="{{ route('superadminpost-category.create') }}">เพิ่มหมวดหมู่</a>
            </div>
        </div>
    </li>

    <!-- Tags -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse" aria-expanded="true"
            aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>แท็ก</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกแท็ก:</h6>
                <a class="collapse-item" href="{{ route('superadminpost-tag.index') }}">แท็ก</a>
                <a class="collapse-item" href="{{ route('superadminpost-tag.create') }}">เพิ่มแท็ก</a>
            </div>
        </div>
    </li>

    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmincomment.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>ความคิดเห็น</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        การตั้งค่าทั่วไป
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadmincoupon.index') }}">
            <i class="fas fa-table"></i>
            <span>คูปอง</span></a>
    </li>
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadminusers.index') }}">
            <i class="fas fa-users"></i>
            <span>ผู้ใช้</span></a>
    </li>
    <!-- General settings -->


    <li class="nav-item">
        <a class="nav-link" href="{{ route('superadminsettings') }}">
            <i class="fas fa-cog"></i>
            <span>ตั้งค่า</span></a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
