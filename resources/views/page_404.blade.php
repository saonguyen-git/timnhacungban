@section('page-title')<?php echo 'Lỗi 404. Trang không tồn tại hoặc đã bị xóa';?>@endsection
@section('page-description')<?php echo 'Không tìm thấy trang';?>@endsection
@include('header')
<style>
    .page-404 {
        min-height: 400px;
        clear: both;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="col-xs-12 page-404">

    <h2 class="col-xs-12 text-center">Lỗi 404. Trang không tồn tại hoặc đã bị xóa</h2>

</div>
@include('footer')