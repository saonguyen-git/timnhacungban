<footer class="col-xs-12 footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 footer-item">
                <h3>Tìm kiếm nhiều nhất</h3>
                <ul>
                    <li><a href="{{url('/')}}/ha-noi" title="Tìm nhà trọ Hà Nội">Tìm nhà trọ Hà Nội</a></li>
                    <li><a href="{{url('/')}}/da-nang" title="Tìm nhà trọ Đà Nẵng">Tìm nhà trọ Đà Nẵng</a></li>
                    <li><a href="{{url('/')}}/tp-ho-chi-min" title="Tìm phòng trọ TP Hồ Chí Minh">Tìm phòng trọ TP Hồ Chí Minh</a></li>
                    <li><a href="{{url('/')}}/search?keyword=Nhà%20trọ%20sinh%20viên" title="Nhà trọ sinh viên">Nhà trọ sinh viên</a></li>
                    <li><a href="{{url('/')}}/search?keyword=Cho%20thuê%20phòng%20trọ%20khép%20kín" title="Cho thuê phòng trọ khép kín">Cho thuê phòng trọ khép kín</a></li>
                    <li><a href="{{url('/')}}/search?keyword=Phòng%20trọ%20gần%20đại%20học%20tài%20chính" title="Phòng trọ gần đại học tài chính">Phòng trọ gần đại học tài chính</a></li>
                    <li><a href="{{url('/')}}//ha-noi?filter=price&min_price=0&max_price=1000000" title="Phòng trọ Hà Nội dưới 1 triệu">Phòng trọ Hà Nội dưới 1 triệu</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 footer-item">
                <h3>HỖ TRỢ KHÁCH HÀNG</h3>
                <ul>
                    <li><a href="#">An toàn mua bán</a></li>
                    <li><a href="#">Quy định cần biết</a></li>
                    <li><a href="#">Liên hệ hỗ trợ</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 footer-item">
                <h3>LIÊN KẾT VỚI CHÚNG TÔI</h3>
                <ul>
                    <li><a href="tel:+84969664896">CSKH: 0969.664.896</a></li>
                    <li><a href="#">Email: hotro.timnhacungban@gmail.com</a></li>
                    <li><p>Mạng xã hội:</p></li>
                    <li>
                        <a href="https://www.facebook.com/timnhacungban.hanoi/" title="facebook">
                            <img class="social lazyload" data-src="{{asset('/imgs/facebook.png')}}" alt="timnhacungban.com"/>
                        </a>
                        <a href="#" title="youtube">
                            <img class="social lazyload" data-src="{{asset('/imgs/youtube.png')}}" alt="timnhacungban.com"/>
                        </a>
                        <a href="#" title="zalo">
                            <img class="social lazyload" data-src="{{asset('/imgs/zalo.png')}}" alt="timnhacungban.com"/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</footer>
<div class="full-width text-center copyright">
    <p>Copyright © 2020 timnhacungban.com - design by Jorry Nguyen</p>
</div>
<script type="text/javascript" src="{{ asset('/js/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/lazysizes.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery-ui.js') }}"></script>
@yield('page-script')
<script>
    $(".select-pos").change(function () {
        var value = $(this).val(),
            type = $(this).attr('data-child'),
            $url = "{{url('/')}}/get-position?type=" + type + "&value=" + value,
            $sl_child = $(".select-" + type);
        if (value !== 'null') {
            $.get($url, function (data) {
                $sl_child.empty();
                $sl_child.append(data);
            });
        }
    });
    $('.datepicker').datepicker();
    var url_hidden = $('.url_hidden'),
        url = '{{url('/')}}/search';

    $(".select-region").change(function () {
        var value = $(this).val();
        if(value !== 'no-data')
        url_hidden.val("{{url('/')}}/"+value);
    });

    $(".btn-search").on('click', function () {

        var search_box = $('#search_box').val(),
            region_name = $('#select-region').val(),
            area_name = $('#select-are').val(),
            ward_name = $('#select-ward').val(),
            url_region = '',
            value_region = '',
            url_area = '',
            value_area = '',
            url_ward = '',
            checked = 0;

        if (search_box == null && region_name == null && area_name == null && ward_name === null) {
            alert("Vui lòng điền đầy đủ thông tin ô search");
        }
        if (region_name !== "no-data") {
            url_region = region_name+'/';
            value_region = '&region_name=' + region_name;
            checked = 1;
        }
        if ( area_name !== 'no-data') {
            url_area = '?area_name=' + area_name;
            value_area = '&area_name=' + area_name;
            checked = 1;
        }
        if ( ward_name !== 'no-data') {
            url_ward = '&ward_name=' + ward_name;
            checked = 1;
        }
        if ((search_box === '' || search_box === null)) {
            if (checked == 1) {
                location.href = "{{url('/')}}/" + url_region + url_area + url_ward;
            }else{
                alert("Vui lòng nhập tìm kiếm ");
            }
        } else {
            location.href = "{{url('/')}}/search?keyword="+ search_box + value_region + value_area + url_ward;
        }
    });

</script>


</body>
</html>