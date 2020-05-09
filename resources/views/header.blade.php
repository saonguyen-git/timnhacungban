<!DOCTYPE html>
<html lang="EN" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('imgs/iv-ic.png')}}">
<!-- Meta Description -->
    <link rel=”canonical” href="{{url('/')}}"/>
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('page-title')</title>
    <meta name="description" content="@yield('page-description')">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-165434317-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-165434317-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TCJTZP2');</script>
    <!-- End Google Tag Manager -->
    <script data-ad-client="ca-pub-2121605246602594" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    @yield('page-css')
    <style>a{text-decoration:none}.no-padding{padding:0}.full-width{float:left;width:100%}img{max-width:100%}.header{color:#fff}.header .container,.sidebar-header .container{padding:0}.header-wrapper{display:flex;justify-content:space-between;align-items:center;padding:10px 0}.header-wrapper h3{margin:0}.header-wrapper .logo img{width:150px;filter:invert(14%) sepia(60%) saturate(5664%) hue-rotate(155deg) brightness(93%) contrast(101%)}.header-right .top-menu{color:#006837;display:inline-block;padding:0 15px;text-transform:uppercase;line-height:35px;transition:.5s;text-decoration:none;font-size:13px;font-weight:600}.header-right .top-menu:hover{background-color:#006837;color:#fff;text-decoration:none}.sidebar-header{background-color:#006837;padding:30px 0}.search-form .form-group{margin:0}.form-group.form-right{padding-left:0}.form-group.form-right .form-right-wrapper{display:flex;justify-content:space-between}.form-group.form-right select{width:27%;padding:0 10px;border:none}#search_box,.btn-search{border-radius:0;border:none;box-shadow:unset}.btn-search{font-weight:600;text-transform:uppercase;font-size:13px;line-height:34px;padding:0 15px;border:none;background-color:#fff;box-shadow:none;color:#006837}.pagination .btn{border-radius:0;transition:.5s;border:1px solid #e5e5e5}.pagination .active,.pagination .btn:hover{background-color:#006837;color:#fff;border:1px solid #006837}.pagination .active{cursor:no-drop}.footer{background-color:#333;color:#fff;padding:60px 0}.footer h3{margin:0;line-height:1.625;text-transform:uppercase}.footer img.social{width:40px}.footer ul{margin:0;padding:0;margin-top:30px}.footer ul li{list-style:none;width:100%}.footer ul li a{color:#dedede;line-height:30px}.copyright p{line-height:30px;margin:0;width:100%}@media only screen and (max-width:480px){.header{padding:0}.header-wrapper{display:block}.sidebar-header{padding:15px 0}.sidebar-header .container{padding:0 15px}.header-wrapper .header-left{text-align:center}.header-wrapper .logo img{width:80%}.header-right{width:100%;float:left;margin-top:20px;border-top:1px solid #006837}.header-right .top-menu{float:left;width:33.3333%;padding:0;font-size:12px;text-align:center}.header-right .top-menu:nth-child(2n){border-left:1px solid #006837;border-right:1px solid #006837}.form-group.form-right{padding-left:15px}.form-group.form-right .form-right-wrapper{display:block;margin-top:15px;width:auto;margin-left:-7px;margin-right:-7px}.form-group.form-right select{height:34px;float:left;width:calc(33.33333% - 14px);margin:0 7px;padding:0}.btn-search{margin:15px 7px 0 7px;width:calc(100% - 14px)}.footer-item{margin-top:30px}.footer{padding:30px 0}.footer h3{font-size:18px}.footer ul{margin-top:0}}    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TCJTZP2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="col-xs-12 header">
    <div class="container">
        <div class="header-wrapper">
            <div class="header-left">
                <h3 title="Sinh viên tìm nhà trọ">
                    <a class="logo" title="timnhacungban.com" href="{{url('/')}}">
                        <img class="lazyload" data-src="{{asset('/imgs/logo-light.svg')}}" alt="timnhacungban.com"/>
                    </a>
                </h3>
            </div>
            <div class="header-right">
                <a class="top-menu" href="{{url('/')}}" title="Phòng trọ sinh viên">Tin Phòng trọ</a>
                <a class="top-menu" href="{{url('/')}}/viec-lam-sinh-vien" title="Việc làm sinh viên">Tin Việc làm</a>
                <a class="top-menu" href="{{url('/')}}/dang-tin-mien-phi" title="Đăng tin miễn phí">Đăng tin miễn
                    phí</a>
            </div>
        </div>
    </div>
</header>
<div class="col-xs-12 sidebar-header">
    <div class="container">
        <div class="row search-form">
            <div class="col-xs-12 col-sm-6 col-md-5 form-group">
                <input type="text" name="search_box" id="search_box" class="form-control" @if(!empty($keyword)) value="{!! $keyword !!}" @endif
                       placeholder="Bạn cần tìm gì?..."/>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-7 form-group form-right">
                <div class="full-width form-right-wrapper">
                    <?php $region_array = array('ha-noi' => 'Hà Nội', 'tp-ho-chi-minh' => 'Tp Hồ Chí Minh', 'da-nang' => 'Đà Nẵng');?>

                    <select class="select-pos select-region" id="select-region" data-child="area">
                        <option value="no-data">Chọn Tỉnh Thành</option>
                        @foreach ($region_array as $key => $region_item)
                            <option value="{{$key}}" <?php if (!empty($region) && $region === $key) {echo 'selected';}?>>{{$region_item}}</option>
                        @endforeach
                    </select>

                    <select class="select-pos select-area" id="select-are" data-child="ward">
                        <option value="no-data">Chọn Quận/Huyện</option>
                        @if(!empty($value_pos))
                            @foreach($value_pos['list_area'] as $item)
                                <option value="{{ $item->slug }}" <?php if (!empty($_GET['area_name']) && $_GET['area_name'] === $item->slug) {echo 'selected';}?>>{!! $item->name !!}</option>
                            @endforeach
                        @endif
                    </select>

                    <select class="select-ward" id="select-ward">
                        <option value="no-data">Chọn Xã/Phường</option>

                        @if(!empty($value_pos) && !empty($value_pos['list_ward']))
                            @foreach($value_pos['list_ward'] as $item)
                                <option value="{{ $item->slug }}" <?php if (!empty($_GET['ward_name']) && $_GET['ward_name'] === $item->slug) {echo 'selected';}?>>{!! $item->name !!}</option>
                            @endforeach
                        @endif
                    </select>
                    <input type="hidden" class="url_hidden" />
                    <button class="btn btn-search">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
</div>
