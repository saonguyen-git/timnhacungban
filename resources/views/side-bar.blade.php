<style>.content-right .sidebar{padding-right:15px}.list-price{margin:0;padding:0}.list-price li.item-price{float:left;width:100%;list-style:none;margin-top:15px}.list-price li.item-price a{display:inline-block;line-height:40px;padding:0 15px;border:1px solid #e5e5e5;width:100%;text-decoration:none;font-weight:700;color:#333;transition:.5s}.list-price li.item-price a:hover,.list-price li.item-price.active a{color:#006837;border:1px solid #006837}</style>
<div class="full-width sidebar hidden-xs">
    <h3 class="entry-title">Lọc theo khoảng giá</h3>
    <ul class="list-price">
        <?php
        $list_price = array(
            '&min_price=0&max_price=1000000' => 'Dưới 1.000.000 đ',
            '&min_price=1000000&max_price=2000000' => '1.000.000 đ - 2.000.000 đ',
            '&min_price=2000000&max_price=3000000' => '2.000.000 đ - 3.000.000 đ',
            '&min_price=3000000&max_price=4000000' => '3.000.000 đ - 4.000.000 đ',
            '&min_price=4000000&max_price=5000000' => '4.000.000 đ - 5.000.000 đ',
            '&min_price=5000000&max_price=150000000' => 'Trên 5.000.000 đ',
        );
        $check_key = '';
        if (!empty($_GET['min_price'])) {
            $min_price = $_GET['min_price'];
            $max_price = $_GET['max_price'];
            $check_key = "&min_price=$min_price&max_price=$max_price";
        }

        ?>
        @foreach( $list_price as $key=>$value)
            <?php
            $class_active = '';
            if ($check_key === $key) {
                $class_active = 'active';
            }
            ?>
            <li class="item-price {{$class_active}}"><a href="{{$url_price}}{{$key}}"> {{$value}} </a></li>
        @endforeach
    </ul>
</div>

<div id="modal_filter" class="modal fade" role="dialog">
    <div class="modal-dialog container">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">BỘ LỌC NÂNG CAO</h4>
            </div>
            <div class="modal-body">
                <div class="full-width sidebar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>