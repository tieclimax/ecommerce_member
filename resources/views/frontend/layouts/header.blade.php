<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings = DB::table('settings')->get();

                            @endphp
                            <li><i class="ti-headphone-alt"></i>
                                @foreach ($settings as $data) {{ $data->phone }}
                                @endforeach
                            </li>
                            <li><i class="ti-email"></i>
                                @foreach ($settings as $data) {{ $data->email }}
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">

                            <li><i class="ti-location-pin"></i> <a href="{{ route('order.track') }}">ติดตามสินค้า</a>
                            </li>
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth
                                @if (Auth::user()->role == 'superadmin')
                                    <li><i class="ti-user"></i> <a href="{{ route('superadmin') }}"
                                            target="_blank">แดชบอร์ด</a>
                                    </li>
                                @elseif (Auth::user()->role == 'admin')
                                    <li><i class="ti-user"></i> <a href="{{ route('admin') }}"
                                            target="_blank">แดชบอร์ด</a>
                                    </li>
                                @else
                                    <li><i class="ti-shopping-cart-full"></i> <a
                                            href="{{ route('register.seller') }}">ขายสินค้ากับท็อปช็อป</a>
                                    </li>
                                    <li><i class="ti-user"></i> <a href="{{ route('user') }}" target="_blank">แดชบอร์ด</a>
                                    </li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{ route('user.logout') }}">ออกจากระบบ</a>
                                </li>

                            @else
                                <li><i class="ti-power-off"></i><a href="{{ route('login.form') }}">เข้าสู่ระบบ /</a>
                                    <a href="{{ route('register.form') }}">สมัครสมาชิก</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <h4><img src={{ asset('images/icons/ecommerce.png') }} style="width: 32px;">
                                <span class="mr-2">TopShop</span>
                            </h4>
                        </a>

                        {{-- @php
                            $settings=DB::table('settings')->get();
                        @endphp --}}
                        {{-- <a href="{{ route('home') }}"><img src="@foreach ($settings as $data) {{ $data->logo }} @endforeach" alt="logo"></a> --}}
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="ค้นหาสินค้า ..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option>หมวดหมู่ทั้งหมด</option>
                                @foreach (Helper::getAllCategory() as $cat)
                                    <option>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <form method="POST" action="{{ route('product.search') }}">
                                @csrf
                                <input name="search" placeholder="ค้นหาสินค้า ..." type="search">
                                <button class="btnn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar shopping">
                            @php
                                $total_prod = 0;
                                $total_amount = 0;
                            @endphp
                            @if (session('wishlist'))
                                @foreach (session('wishlist') as $wishlist_items)
                                    @php
                                        $total_prod += $wishlist_items['quantity'];
                                        $total_amount += $wishlist_items['amount'];
                                    @endphp
                                @endforeach
                            @endif
                            <a href="{{ route('wishlist') }}" class="single-icon"><i class="fa fa-heart-o"></i> <span
                                    class="total-count">{{ Helper::wishlistCount() }}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromWishlist()) }} รายการ</span>
                                        <a href="{{ route('wishlist') }}">ดูสิ่งที่อยากได้</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                        @foreach (Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('wishlist-delete', $data->id) }}" class="remove"
                                                    title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}"></a>
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                        target="_blank">{{ $data->product['title'] }}</a></h4>
                                                <p class="quantity">{{ $data->quantity }} x - <span
                                                        class="amount">฿{{ number_format($data->price, 2) }}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>ทั้งหมด</span>
                                            <span
                                                class="total-amount">฿{{ number_format(Helper::totalWishlistPrice(), 2) }}</span>
                                        </div>
                                        <a href="{{ route('cart') }}" class="btn animate">ตะกร้าสินค้า</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                        {{-- <div class="sinlge-bar">
                            <a href="{{route('wishlist')}}" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('cart') }}" class="single-icon"><i class="ti-bag"></i> <span
                                    class="total-count">{{ Helper::cartCount() }}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(Helper::getAllProductFromCart()) }} รายการ</span>
                                        <a href="{{ route('cart') }}">ดูตะกร้าสินค้า</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                        @foreach (Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo = explode(',', $data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{ route('cart-delete', $data->id) }}" class="remove"
                                                    title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="#"><img src="{{ $photo[0] }}"
                                                        alt="{{ $photo[0] }}"></a>
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}"
                                                        target="_blank">{{ $data->product['title'] }}</a></h4>
                                                <p class="quantity">{{ $data->quantity }} x - <span
                                                        class="amount">฿{{ number_format($data->price, 2) }}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>ทั้งหมด</span>
                                            <span
                                                class="total-amount">฿{{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                        </div>
                                        <a href="{{ route('checkout') }}" class="btn animate">เช็คเอาท์</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{ Request::path() == 'home' ? 'active' : '' }}"><a
                                                    href="{{ route('home') }}">หน้าแรก</a></li>
                                            {{ Helper::getHeaderCategory() }}
                                            <li class="{{ Request::path() == 'about-us' ? 'active' : '' }}"><a
                                                    href="{{ route('about-us') }}">เกี่ยวกับเรา</a></li>
                                            <li class="@if (Request::path()=='product-grids' ||
                                                Request::path()=='product-lists' ) active @endif"><a href="{{ route('product-grids') }}">สินค้าทั้งหมด</a><span
                                                    class="new">สินค้าใหม่</span></li>
                                            <li class="{{ Request::path() == 'blog' ? 'active' : '' }}"><a
                                                    href="{{ route('blog') }}">บทความ</a></li>

                                            <li class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a
                                                    href="{{ route('contact') }}">ติดต่อเรา</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
