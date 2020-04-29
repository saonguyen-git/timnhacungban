@section('page-title')<?php echo 'Trang chủ | phongtrosinhvien.com | Phòng trọ sinh viên | Sinh viên tìm nhà trọ | Phòng trọ cho thuê | Nhà trọ Hà Nội | Nhà trọ Sài Gòn';?>@endsection
@section('page-description')<?php echo 'Sau dịch bện covid 19. Sinh viên cả nước lại tiếp tục nhập học, do vậy nhu cầu trở lại các trường tăng cao dẫn đến nhu cầu tìm nhà trọ tăng cao. Phongtrosinhvien.com sẽ cung cấp cho các bạn sinh viên những tin nhà trọ mới nhất, chính xác nhất và hoàn toàn miễn phí';?>@endsection
@include('header')
<style>
    .content {
        padding: 90px 0;
    }

    .content .entry-title {
        margin: 0;
        line-height: 1;
        text-transform: uppercase;
        font-weight: bold;
        width: 100%;
        background-color: #006837;
        padding: 10px 15px;
        color: #fff;
        font-size: 20px;
    }

    .content .list-item {
        margin-top: 30px;
    }

    .content .item {
        padding: 15px;
        border: 2px solid #e5e5e5;
        margin-bottom: 30px;
        transition: .5s;
    }

    .content .item-thumbnail {
        overflow: hidden;
        max-height: 130px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .content .item .title {
        margin: 0;
        font-weight: 700;
        font-size: 20px;
    }

    .content .item .desc {
        clear: both;
    }

    .content .item .author i {
        font-size: 20px;
    }

    .content .item .price {
        display: inline-block;
        width: 100%;
        margin: 7px 0;
        font-weight: 700;
        color: #c90927;
    }

    .content .item .sub-info {
        display: flex;
        align-items: center;
        color: #999;
        margin-bottom: 0;
    }

    .content .item .sub-info .sur {
        display: inline-block;
        padding: 0;
        width: 1px;
        height: 14px;
        background: #999;
        margin: 0 5px;
    }

    .content .item .item-thumbnail {
        padding: 0;
    }
    .content .item:hover {
        border: 2px solid #006837;
    }
    .content .item:hover> .item-content .title a {
        text-decoration: none;
        color: #006837;
    }
    @media only screen and (max-width: 480px) {
        .content{
            padding: 45px 0;
        }
        .content .row {
            margin: 0;
        }
        .content .entry-title {
            line-height: 1.425;
            width: auto;
            margin: 0 -15px;
        }
        .content .list-item {
           margin-top: 15px;
        }
        .content .list-item .item-content{
            padding: 0;
        }
        .content .item .title {
            margin-top: 10px;
            line-height: 1.425;
            font-size: 18px;
        }
        .content .item .sub-info {
            font-size: 11px;
            justify-content: space-between;
        }
        .content .item .sub-info .author {
            display: flex;
            align-items: center;
        }
        .content .item .author i {
            font-size: 18px;
            padding-right: 5px;
        }
        .content .item .sub-info .sur {
            margin: 0;
        }
        .pagination .btn {
            margin: 5px;
        }
    }
</style>
<div class="col-xs-12 content">
    <div class="container no-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 content-left">
                <h3 class="full-width entry-title">Cho Thuê Phòng Trọ Toàn quốc Giá Rẻ</h3>
                <div class="full-width list-item">
                    @if(!empty($value))
                        @foreach( $value as $item)
                            <div class="full-width item">

                                <div class="col-xs-12 col-sm-3 col-md-3 item-thumbnail">
                                    <a href="{{ url('/') }}/phongtro/{!! $item->slug !!}/{{$item->id_product}}"
                                       title="{!! $item->title !!}">
                                        <?php
                                        if(!empty($item->thumbnail)){
                                            $url_thumbnail = $item->thumbnail;
                                        }else {
                                            $url_thumbnail = asset('/imgs/thumbnail.png');
                                        }
                                        ?>
                                        <img data-src="{{ $url_thumbnail }}" class="lazyload"  alt="{!! ucfirst($item->title) !!}"/>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-9 col-md-9 item-content">
                                    <h3 class="title">
                                        <a href="{{ url('/') }}/phong-tro/{!! $item->slug !!}/{{$item->id_product}}"
                                           title="{!! $item->title !!}">{!! ucfirst($item->title) !!}</a>
                                    </h3>
                                    <span class="price">Giá: {!! number_format(intval($item->price),0,",",".") !!} đ</span>
                                    <p class="desc">
                                        <?php
                                        $desc = $item->body;
                                        $chars_limit = 200;
                                        if (strlen($desc) > $chars_limit) {
                                            $rpos = strrpos(substr($desc, 0, $chars_limit), " ");
                                            if ($rpos !== false) {
                                                echo substr($desc, 0, $rpos) . '...';
                                            } else {
                                                echo substr($desc, 0, $chars_limit) . '...';
                                            }
                                        } else {
                                            echo $desc;
                                        }
                                        ?>
                                    </p>
                                    <?php
                                    $created_at = $item->created_at;
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
                                    <p class="sub-info">
                                        <span class="author">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i> {!! ucfirst($item->account_name) !!}
                                        </span>
                                        <span class="sur"></span>
                                        <span class="time">{{$time_convert}}</span>
                                        <span class="sur"></span>
                                        <span class="position">{{$item->area_name}}</span>
                                    </p>
                                </div>
                            </div>

                        @endforeach

                    @else
                        <h3>Không tìm thấy kết quả nào</h3>
                    @endif
                </div>
                @if(count($value) <= 10)
                    <div class="col-xs-12 text-center pagination">
                        <?php
                        $current_url = url('/');
                        $page = $current_page;
                        ?>
                        @if($page != 1)
                            <a class="btn btn-default" href="{{$current_url}}" data-page="1" title="Trang đầu tiên"> <i
                                        class="fa fa-angle-double-left" aria-hidden="true"></i> </a>
                            <a class="btn btn-default" href="{{$current_url}}?page={{$page - 1}}" title="Trang trước"
                               data-page="{{$page - 1}}"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a>
                        @endif

                        <?php
                        $min = $page - 4;
                        if ($page - 4 == 0) {
                            $min = 1;
                        }
                        $max = $total;

                        if ($page + 4 < $total) {
                            $max = $page + 4;
                        }

                        $total = round($total / 10);
                        ?>

                        @for ($i = $min ; $i <= $max; $i++)
                            @if($i <= $total && $i > 0)
                                <a class="btn btn-default <?php if($page == $i) { ?> active <?php } ?>"
                                   href="{{url('/')}}?page={{$i}}" data-page="{{$i}}" title="Trang {{$i}}">
                                    {{$i}}
                                </a>
                            @endif
                        @endfor

                        @if($page != $total)
                            <a class="btn btn-default" href="{{$current_url}}?page={{$page + 1}}"
                               data-page="{{$page + 1}}" title="Trang tiếp theo"> <i class="fa fa-angle-right"
                                                                                     aria-hidden="true"></i> </a>
                            <a class="btn btn-default" href="{{$current_url}}?page={{$total}}"
                               data-page="{{$total}}" title="Trang cuối cùng">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 no-padding content-right">
                @include('side-bar')
            </div>
        </div>
    </div>
</div>
@include('footer')