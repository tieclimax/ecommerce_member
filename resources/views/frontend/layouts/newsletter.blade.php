<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>จดหมายข่าว</h4>
                        <p> สมัครรับจดหมายข่าวของเราและรับ <span>10%</span> สำหรับการซื้อครั้งแรกของคุณ </p>
                        <form action="{{ route('subscribe') }}" method="post" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="ที่อยู่อีเมลของคุณ..." required="" type="email">
                            <button class="btn" type="submit">ติดตาม</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->
