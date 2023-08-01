@extends('frontend.layouts.master')

@section('title','OTP Confirmation Page')

@section('main-content')

<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">Order Confirmation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');body{background-color: #ffe8d2;font-family: 'Montserrat', sans-serif}.card{border:none}.logo{background-color: #eeeeeea8}.totals tr td{font-size: 13px}.footer{background-color: #eeeeeea8}.footer span{font-size: 12px}.product-qty span{font-size: 12px;color: #dedbdb}
</style>
<!-- End Breadcrumbs -->

<!-- Start Checkout -->
<div class="container mt-5 mb-5">

        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">


                        <div class="text-left logo p-2 px-5">
                        @php
                        $settings=DB::table('settings')->get();
                        @endphp
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{asset('/uploads/images/settings'). '/' . $data->photo}} @endforeach" alt="logo"></a>
                            

                        </div>

                        <div class="invoice p-5">

                            <h5>Your order Confirmed!</h5>

                            <span class="font-weight-bold d-block mt-4">Hello, <?php echo $order->first_name. " ". $order->last_name ?></span>
                            <span>You order has been confirmed and will be shipped in next two days!</span>

                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                <table class="table table-borderless">
                                    
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order Date</span>
                                                <span><?php
                                                use Carbon\Carbon;
                                                echo $order->updated_at->toDayDateTimeString();
                                                // $dt = $order->updated_at;
                                                // echo $dt->toDayDateTimeString;
                                                 ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order No</span>
                                                <span><?php echo $order->order_number ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Payment</span>
                                                <span><?php echo $order->payment_method ?></span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Shiping Address</span>
                                                <span><?php echo $order->address1 ?></span>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>




                                
                            </div>




                                <!-- <div class="product border-bottom table-responsive">

                                    <table class="table table-borderless">

                                    <tbody>
                                        <tr>
                                            <td width="20%">
                                            
                                            <img src="https://i.imgur.com/u11K1qd.jpg" width="90">

                                        </td>
                                    
                                        <td width="60%">
                                            <span class="font-weight-bold">Men's Sports cap</span>
                                            <div class="product-qty">
                                                <span class="d-block">Quantity:1</span>
                                                <span>Color:Dark</span>
                                                
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">$67.50</span>
                                            </div>
                                        </td>
                                        </tr>


                                        <tr>
                                            <td width="20%">
                                            
                                            <img src="https://i.imgur.com/SmBOua9.jpg" width="70">

                                        </td>
                                    
                                        <td width="60%">
                                            <span class="font-weight-bold">Men's Collar T-shirt</span>
                                            <div class="product-qty">
                                                <span class="d-block">Quantity:1</span>
                                                <span>Color:Orange</span>
                                                
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">$77.50</span>
                                            </div>
                                        </td>
                                        </tr>
                                    </tbody> 
                                        
                                    </table>
                                    


                                </div> -->



                                <div class="row d-flex justify-content-end">

                                    <div class="col-md-5">

                                        <table class="table table-borderless">

                                            <tbody class="totals">

                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Subtotal</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span><?php echo $order->sub_total ?></span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Shipping Fee</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span><?php echo ($order->sub_total == $order->total_amount)? "0" : $order->total_amount - $order->sub_total ?></span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <!-- <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Tax Fee</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>$7.65</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Discount</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-success">$168.50</span>
                                                        </div>
                                                    </td>
                                                </tr> -->


                                                 <tr class="border-top border-bottom">
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="font-weight-bold">Total</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="font-weight-bold"><?php echo $order->total_amount ?></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            
                                        </table>
                                        
                                    </div>
                                    


                                </div>


                                <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                                <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                                <span>Sports Shop BD</span>



                            

                        </div>


                        <div class="d-flex justify-content-between footer p-3">

                           
                            
                        </div>



            
        </div>
                
            </div>
            
        </div>
        
    </div>
<!--/ End Checkout -->

<!-- Start Shop Services Area  -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over TK 100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->
@endsection
@push('styles')
<style>
    li.shipping {
        display: inline-flex;
        width: 100%;
        font-size: 14px;
    }

    li.shipping .input-group-icon {
        width: 100%;
        margin-left: 10px;
    }

    .input-group-icon .icon {
        position: absolute;
        left: 20px;
        top: 0;
        line-height: 40px;
        z-index: 3;
    }

    .form-select {
        height: 30px;
        width: 100%;
    }

    .form-select .nice-select {
        border: none;
        border-radius: 0px;
        height: 40px;
        background: #f6f6f6 !important;
        padding-left: 45px;
        padding-right: 40px;
        width: 100%;
    }

    .list li {
        margin-bottom: 0 !important;
    }

    .list li:hover {
        background: #F7941D !important;
        color: white !important;
    }

    .form-select .nice-select::after {
        top: 14px;
    }
</style>
@endpush
@push('scripts')
<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("select.select2").select2();
    });

    $('select.nice-select').niceSelect();
</script>
<script>
    $("input[name$='payment_method']").click(function() {
        var test = $(this).val();
        if (test == "bkash") {
            $("#bkash_div").show();
        } else {
            $("#bkash_div").hide();
        }
    });

    function showMe(box) {
        var checkbox = document.getElementById('shipping').style.display;
        // alert(checkbox);
        var vis = 'none';
        if (checkbox == "none") {
            vis = 'block';
        }
        if (checkbox == "block") {
            vis = "none";
        }
        document.getElementById(box).style.display = vis;
    }
</script>
<script>
    $(document).ready(function() {
        $('.shipping select[name=shipping]').change(function() {
            let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
            let subtotal = parseFloat($('.order_subtotal').data('price'));
            let coupon = parseFloat($('.coupon_price').data('price')) || 0;
            // alert(coupon);
            $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
        });

    });
</script>

@endpush