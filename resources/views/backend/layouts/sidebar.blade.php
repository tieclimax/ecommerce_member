<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
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
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>แดชบอร์ด</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        แบนเนอร์
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('file-manager') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>ผู้จัดการสื่อ</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-image"></i>
            <span>แบนเนอร์</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกแบนเนอร์:</h6>
                <a class="collapse-item" href="{{ route('banner.index') }}">แบนเนอร์</a>
                <a class="collapse-item" href="{{ route('banner.create') }}">เพิ่มแบนเนอร์</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        ร้านค้า
    </div>

    <!-- My shop -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myshopCollapse" aria-expanded="true"
            aria-controls="myshopCollapse">
            <i class="fas fa-shopping-bag"></i>
            <span>ร้านค้าของฉัน</span>
        </a>
        <div id="myshopCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกร้านค้าของฉัน:</h6>
                <a class="collapse-item" href="{{ route('myproduct.index') }}">สินค้า</a>
                <a class="collapse-item" href="{{ route('myproduct.productpadding') }}">สินค้ารอการตรวจสอบ</a>
                <a class="collapse-item" href="{{ route('myproduct.create') }}">เพิ่มสินค้า</a>
            </div>
        </div>
    </li>
    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse"
            aria-expanded="true" aria-controls="categoryCollapse">
            <i class="fas fa-sitemap"></i>
            <span>หมวดหมู่</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกหมวดหมู่:</h6>
                <a class="collapse-item" href="{{ route('category.index') }}">หมวดหมู่</a>
                <a class="collapse-item" href="{{ route('category.create') }}">เพิ่มหมวดหมู่</a>
            </div>
        </div>
    </li>
    {{-- Products
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse"
            aria-expanded="true" aria-controls="productCollapse">
            <i class="fas fa-cubes"></i>
            <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Product Options:</h6>
                <a class="collapse-item" href="{{ route('product.index') }}">Products</a>
                <a class="collapse-item" href="{{ route('product.create') }}">Add Product</a>
            </div>
        </div>
    </li> --}}

    {{-- Brands --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true"
            aria-controls="brandCollapse">
            <i class="fas fa-table"></i>
            <span>ยี่ห้อ</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกยี่ห้อ:</h6>
                <a class="collapse-item" href="{{ route('brand.index') }}">ยี่ห้อ</a>
                <a class="collapse-item" href="{{ route('brand.create') }}">เพิ่มยี่ห้อ</a>
            </div>
        </div>
    </li>

    {{-- Shipping --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse"
            aria-expanded="true" aria-controls="shippingCollapse">
            <i class="fas fa-truck"></i>
            <span>การจัดส่ง</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">ตัวเลือกการจัดส่ง:</h6>
                <a class="collapse-item" href="{{ route('shipping.index') }}">การจัดส่ง</a>
                <a class="collapse-item" href="{{ route('shipping.create') }}">เพิ่มการจัดส่ง</a>
            </div>
        </div>
    </li>

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>คำสั่งซื้อ</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('review.index') }}">
            <i class="fas fa-comments"></i>
            <span>บทวิจารณ์</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- <!-- Heading -->
    <div class="sidebar-heading">
        กระทู้
    </div> --}}

    {{-- <!-- Posts -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true"
            aria-controls="postCollapse">
            <i class="fas fa-fw fa-folder"></i>
            <span>กระทู้</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Post Options:</h6>
                <a class="collapse-item" href="{{ route('post.index') }}">กระทู้</a>
                <a class="collapse-item" href="{{ route('post.create') }}">เพิ่มกระทู้</a>
            </div>
        </div>
    </li> --}}

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
                <a class="collapse-item" href="{{ route('post-category.index') }}">หมวดหมู่</a>
                <a class="collapse-item" href="{{ route('post-category.create') }}">เพิ่มหมวดหมู่</a>
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
                <a class="collapse-item" href="{{ route('post-tag.index') }}">แท็ก</a>
                <a class="collapse-item" href="{{ route('post-tag.create') }}">เพิ่มแท็ก</a>
            </div>
        </div>
    </li>

    <!-- Comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('comment.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>ความคิดเห็น</span>
        </a>
    </li>


    {{-- <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        การตั้งค่าทั่วไป
    </div> --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('coupon.index') }}">
            <i class="fas fa-table"></i>
            <span>คูปอง</span></a>
    </li>
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>ผู้ใช้</span></a>
    </li> --}}
    <!-- General settings -->


    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('settings') }}">
            <i class="fas fa-cog"></i>
            <span>ตั้งค่า</span></a>
    </li> --}}


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
