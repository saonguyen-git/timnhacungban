@section('page-title')<?php if (!empty($get_detail)) {
    echo $get_detail->title;
} else {
    echo 'Không tìm thấy trang';
}?>@endsection
@section('page-description')<?php if (!empty($get_detail)) {
    echo $get_detail->body;
} else {
    echo 'Không tìm thấy trang';
}?>@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css"
          href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>@endsection
@include('header')

<style>
    .content {
        padding: 90px 0;
    }

    .content-wrapper .content-left {
        border: 2px solid #e5e5e5;
        padding: 15px;
    }

    .breadcrumb {
        background-color: #006837;
        border-radius: 0;
        color: #e5e5e5;
    }

    .breadcrumb a {
        color: #fff;
        transition: .5s;
    }

    .breadcrumb a:hover {
        text-decoration: none;
    }

    .list-slide .item-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #eee;
    }

    .list-slide .item-wrapper img {
        max-width: 100%;
        max-height: 100%;
    }

    .list-slide .slick-dots {
        padding: 0;
        width: fit-content;
        margin: 0 auto;
        position: absolute;
        bottom: 40px;
        left: calc(50% - 18px);
        z-index: 99;
    }

    .list-slide .slick-dots li {
        float: left;
        display: inline-block;
        list-style: none;
        margin: 2px;
    }

    .list-slide .slick-dots li button {
        font-size: 0;
        line-height: 0;
        display: flex;
        width: 10px;
        height: 10px;
        padding: 2px;
        cursor: pointer;
        color: transparent;
        border: 0;
        outline: none;
        background: #e5e5e5;
        border-radius: 100%;
    }

    .list-slide .slick-dots li.slick-active button {
        background-color: #333;
    }

    .slider-thumbnail {
        position: relative;
    }

    .sub-thumbnail {
        width: 100%;
        position: absolute;
        background: rgba(0, 0, 0, 0.8);
        bottom: 0;
    }

    .sub-thumbnail p {
        width: 100%;
        text-align: right;
        color: #fff;
        line-height: 30px;
        margin: 0;
        padding: 0 15px;
    }

    .detail {
        clear: both;
    }

    .detail .title {
        font-size: 18px;
        font-weight: 700;
    }

    .detail .price {
        font-weight: 700;
        color: #c0392b;
        font-size: 16px;
    }

    .position {
        display: flex;
        align-items: center;
    }

    .position i {
        font-size: 24px;
        color: #555;
        margin-right: 10px;
    }

    .description {
        margin-top: 10px;
    }

    .report {
        border-top: 2px dashed #e5e5e5;
        margin-top: 25px;
    }

    .report .title {
        font-weight: 700;
        color: #006837;
    }

    .report .btn {
        border-radius: 0;
        border: 1px solid #e5e5e5;
        box-shadow: none;
    }

    .content-right {
        padding-right: 0;
    }

    .sidebar-wrapper {
        width: 100%;
        float: left;
        border: 2px solid #e5e5e5;
        padding: 15px;
    }

    .content-right .entry-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        text-transform: uppercase;
        line-height: 1.425;
    }

    .info-author .name {
        display: flex;
        align-items: center;
        margin-top: 15px;
        margin-bottom: 0;
    }

    .info-author .name i {
        font-size: 30px;
        color: #555;
        padding: 3px;
        border: 1px solid #e5e5e5;
        border-radius: 100%;
    }

    .info-author .name span {
        line-height: 30px;
        font-size: 16px;
        font-weight: 700;
        margin-left: 10px;
    }

    .info-author .phone {
        display: flex;
        line-height: 40px;
        width: 100%;
        text-align: center;
        background-color: #006837;
        border: 1px solid #006837;
        color: #fff;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: 700;
        transition: .5s;
        margin-top: 15px;
    }

    .info-author .phone i {
        font-size: 24px;
        padding-right: 10px;
    }

    .info-author .phone:hover {
        text-decoration: none;
        color: #006837;
        background-color: #fff;
    }

    .relate-post .row {
        margin-left: -7px;
        margin-right: -7px;
    }

    ul.list-post {
        padding: 0;
        margin-bottom: 0;
        margin-top: 15px;
    }

    ul.list-post li {
        list-style: none;
        margin-bottom: 5px;
        font-weight: bold;
    }

    ul.list-post li:last-child {
        margin-bottom: 0;
    }

    .relate-post .item {
        padding: 0 7px;
    }

    .relate-post .item .item-thumbnail {
        position: relative;
    }

    .relate-post .item .item-thumbnail a {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 120px;
        overflow: hidden;
        background: #e5e5e5;
    }

    .relate-post .item .item-content {
        padding: 10px;
        border: 1px solid #e5e5e5;
    }

    .relate-post .item .title {
        margin-top: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .relate-post .item .title a {
        color: #0b0b0b;
        line-height: 1.325;
        transition: .5s;
    }

    .relate-post .item .title a:hover {
        color: #006837;
        text-decoration: none;
    }

    .relate-post .item .price {
        color: #c0392b;
        font-weight: bold;
    }

    .relate-post .item .sub-info {
        margin: 0;
        position: absolute;
        background: rgba(256, 256, 256, 0.7);
        top: 5px;
        right: 5px;
        padding: 0 5px;
        font-size: 12px;
        line-height: 20px;
        font-weight: bold;
    }

    .relate-post .entry-title {
        margin-bottom: 15px;
        margin-top: 0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 20px;
    }

    .relate-post .slide-arrow {
        position: absolute;
        top: -43px;
        display: flex !important;
        justify-content: center;
        width: 30px;
        height: 30px;
        border: 1px solid #006837;
        color: #006837;
        align-items: center;
        font-size: 20px;
        cursor: pointer;
        transition: .5s;
    }

    .relate-post .slide-arrow:hover {
        background-color: #006837;
        color: #fff;
    }

    .relate-post .slide-arrow.left-arrow {
        right: 50px;
    }

    .relate-post .slide-arrow.right-arrow {
        right: 7px;
    }

    @media only screen and (max-width: 480px) {
        .content {
            padding: 15px 0;
        }

        .content .row {
            margin: 0;
        }

        .sub-thumbnail p {
            text-align: center;
        }

        .content-right {
            padding: 0;
            margin-top: 15px;
        }

        .content .relate-post .row {
            margin: 0 -7px;
        }

        .relate-post .item .item-thumbnail a {
            height: 100px;
        }

        .relate-post .item .title {
            font-size: 13px;
        }

        .report .btn {
            float: left;
            width: 50%;
        }

        .report .btn:last-child {
            width: 100%;
        }
    }
</style>

<div class="col-xs-12 content">
    <div class="container content-wrapper">
        @if( !empty($get_detail))
            <div class="row">
                <p class="breadcrumb">
                    <a href="{{url('/')}}" title="trang chủ">Trang chủ</a>
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    <a href="{{url('/')}}" title="phòng trọ">Phòng trọ</a>
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    <span>{!! $get_detail->title !!}</span>
                </p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 content-left">
                    <div class="full-width slider-thumbnail">
                        <?php
                        $list_slider = $get_detail->slide;
                        $created_at = $get_detail->created_at;
                        $date_now = date("Y-m-d H:i:s");
                        $theDiff = "";
                        $datetime1 = date_create($created_at);
                        $datetime2 = date_create($date_now);
                        $interval = date_diff($datetime1, $datetime2);
                        $min = $interval->format('%i');
                        $sec = $interval->format('%s');
                        $hour = $interval->format('%h');
                        $mon = $interval->format('%m');
                        $day = $interval->format('%d');
                        $year = $interval->format('%y');
                        if ($interval->format('%i%h%d%m%y') == "00000") {
                            $time_convert = $sec . " giây trước";
                        } else if ($interval->format('%h%d%m%y') == "0000") {
                            $time_convert = $min . " phút trước";
                        } else if ($interval->format('%d%m%y') == "000") {
                            $time_convert = $hour . " giờ trước";
                        } else if ($interval->format('%m%y') == "00") {
                            $time_convert = $day . " ngày trước";
                        } else if ($interval->format('%y') == "0") {
                            $time_convert = $mon . " tháng trước";
                        } else {
                            $time_convert = $year . " năm trước";
                        }
                        if (!empty($list_slider)) {
                            $list_slider = explode(',', $list_slider);
                        }
                        ?>
                        @if(!empty($list_slider))
                            <div class="list-slide">

                                @foreach($list_slider as $item_slide)
                                    <div class="item">
                                        <div class="item-wrapper">
                                            <img class="lazyload" data-src="{{$item_slide}}"
                                                 alt="{!! $get_detail->title !!}"/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <img class="lazyload" data-src="{{asset('/imgs/thumbnail-large.png')}}"
                                 alt="{!! $get_detail->title !!}"/>
                        @endif
                        <div class="sub-thumbnail">
                            <p>Tin cá nhân đăng {{$time_convert}}</p>
                        </div>
                    </div>

                    <div class="full-width detail">
                        <h3 class="title" title="{!! $get_detail->title !!}">{!! $get_detail->title !!}</h3>
                        <p class="full-width">
                            <span class="price">Giá: {{ number_format(intval($get_detail->price),0,",",".") }} vnđ/tháng </span>
                            - <span class="area">Diện tích: {{$get_detail->size}} m²</span></p>
                        <p class="full-width position"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{$get_detail->address}}, {{$get_detail->ward_name}}, {{$get_detail->area_name}}, {{$get_detail->region_name}}</span>
                        </p>
                        <p class="full-width description">
                            {!! $get_detail->body !!}
                        </p>
                    </div>
                    <div class="full-width report">
                        <h4 class="title">Báo cáo tin</h4>
                        <button class="btn btn-default" id="rp-mg">Báo cáo môi giới</button>
                        <button class="btn btn-default" id="rp-news">Báo tin không hợp lệ</button>
                        <button class="btn btn-default" id="rp-passed">Báo cáo đã bán</button>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 content-right">
                    <div class="sidebar-wrapper">
                        <h3 class="entry-title">Liên hệ</h3>
                        <div class="full-width info-author">
                            <p class="name">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span>{!! ucfirst($get_detail->account_name) !!}</span>
                            </p>
                            <a class="phone" href="tel:+84{{$get_detail->phone}}"><i class="fa fa-phone"
                                                                                     aria-hidden="true"></i>
                                0{{number_format(intval($get_detail->phone),0,",",".")}}</a>
                        </div>
                    </div>
                    <div class="col-xs-12" style="height: 30px;clear: both;"></div>
                    <div class="sidebar-wrapper">
                        <h3 class="entry-title">Cho thuê phòng trọ {{$get_detail->ward_name}}</h3>
                        <ul class="list-post">
                            @if(!empty($get_ward))
                                @foreach($get_ward as $ward_item)
                                    <li class="post-item">
                                        <a href="{{ url('/') }}/phong-tro/{!! $ward_item->slug !!}/{{$ward_item->id_product}}"
                                           title="{!! $ward_item->title !!}">
                                            {!! $ward_item->title !!}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="height: 30px;clear: both;"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 content-left relate-post">
                    <h3 class="entry-title">Tin tương tự</h3>
                    <div class="row">
                        <div class="list-item">
                            @if(!empty($get_relate))

                                @foreach( $get_relate as $item_relate)

                                    <div class="col-xs-6 col-sm-3 col-md-3 item">
                                        <?php
                                        $created_at = $item_relate->created_at;
                                        $date_now = date("Y-m-d H:i:s");
                                        $theDiff = "";
                                        $datetime1 = date_create($created_at);
                                        $datetime2 = date_create($date_now);
                                        $interval = date_diff($datetime1, $datetime2);
                                        $min = $interval->format('%i');
                                        $sec = $interval->format('%s');
                                        $hour = $interval->format('%h');
                                        $mon = $interval->format('%m');
                                        $day = $interval->format('%d');
                                        $year = $interval->format('%y');
                                        if ($interval->format('%i%h%d%m%y') == "00000") {
                                            $time_convert = $sec . " giây trước";
                                        } else if ($interval->format('%h%d%m%y') == "0000") {
                                            $time_convert = $min . " phút trước";
                                        } else if ($interval->format('%d%m%y') == "000") {
                                            $time_convert = $hour . " giờ trước";
                                        } else if ($interval->format('%m%y') == "00") {
                                            $time_convert = $day . " ngày trước";
                                        } else if ($interval->format('%y') == "0") {
                                            $time_convert = $mon . " tháng trước";
                                        } else {
                                            $time_convert = $year . " năm trước";
                                        }
                                        ?>

                                        <div class="full-width item-thumbnail">
                                            <a href="{{ url('/') }}/phongtro/{!! $item_relate->slug !!}/{{$item_relate->id_product}}"
                                               title="{!! $item_relate->title !!}">
                                                <?php
                                                if(!empty($item_relate->thumbnail)){
                                                    $url_thumbnail = $item_relate       ->thumbnail;
                                                }else {
                                                    $url_thumbnail = asset('/imgs/thumbnail.png');
                                                }
                                                ?>
                                                <img data-src="{{ $url_thumbnail }}" class="lazyload"
                                                     alt="{!! ucfirst($item_relate->title) !!}"/>
                                            </a>
                                            <p class="sub-info">
                                                <span class="time">{{$time_convert}}</span>
                                            </p>
                                        </div>
                                        <div class="full-width item-content">
                                            <h3 class="title">
                                                <a href="{{ url('/') }}/phong-tro/{!! $item_relate->slug !!}/{{$item_relate->id_product}}"
                                                   title="{!! $item_relate->title !!}">{!! ucfirst($item_relate->title) !!}</a>
                                            </h3>
                                            <span class="price">Giá: {!! number_format(intval($item_relate->price),0,",",".") !!} đ</span>

                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@section('page-script')

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.list-slide').slick({
            dots: true,
            infinite: false,
            slidesToShow: 1,
            arrows: false
        });
        $('.relate-post .list-item').slick({
            dots: false,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: true,
            prevArrow: '<div class="slide-arrow left-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
            nextArrow: '<div class="slide-arrow right-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
    </script>
@endsection

@include('footer')