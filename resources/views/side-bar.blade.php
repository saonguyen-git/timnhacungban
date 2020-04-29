<style>
    .content-right .sidebar {
        padding-right: 15px;
    }

    .sidebar-content {
        border: 2px solid #e5e5e5;
        margin-top: 30px;
        padding: 15px;
    }

    .sidebar-content .filter-title {
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 1;
    }

    .filter-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .filter-form input {
        border-radius: 0;
        border: 1px solid #e5e5e5;
        box-shadow: none;
        width: 45%;
        height: 30px;
    }

    .sidebar-button {
        margin-top: 30px;
    }

    .bt-filter {
        border-radius: 0;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 12px;
        border: 1px solid #006837;
        background-color: #006837;
        color: #fff;
        padding: 0;
        line-height: 30px;
        width: 100%;
        transition: .5s;
    }

    .bt-filter:hover {
        background-color: #fff;
        color: #006837;
    }
</style>
<div class="full-width sidebar hidden-xs">
    <h3 class="entry-title">Bộ lọc nâng cao</h3>
    <div class="sidebar-content">
        <p class="filter-title">Lọc theo khoảng giá: </p>
        <div class="filter-form">
            <input type="number" name="price_from" class="form-control price_from" placeholder=""/>
            <span>-</span>
            <input type="number" name="price_to" class="form-control price_to"/>
        </div>
    </div>

    <div class="sidebar-content">
        <p class="filter-title">Lọc theo diện tích: </p>
        <div class="filter-form">
            <input type="number" name="size_from" class="form-control size_from" placeholder=""/>
            <span>-</span>
            <input type="number" name="size_to" class="form-control size_to"/>
        </div>
    </div>

    <div class="sidebar-content">
        <p class="filter-title">Lọc theo ngày đăng: </p>
        <div class="filter-form">
            <input type="text" name="date_from" class="form-control datepicker date_from" placeholder=""/>
            <span>-</span>
            <input type="text" name="date_to" class="form-control datepicker date_to"/>
        </div>
    </div>
    <div class="full-width sidebar-button text-center">
        <button class="btn btn-default bt-filter">Áp dụng</button>
    </div>
</div>

<div id="modal_filter" class="modal fade" role="dialog">
    <div class="modal-dialog container">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">BỘ LỌC NÂNG CAO</h4>
            </div>
            <div class="modal-body">
                <div class="full-width sidebar">
                    <h3 class="entry-title">Bộ lọc nâng cao</h3>
                    <div class="sidebar-content">
                        <p class="filter-title">Lọc theo khoảng giá: </p>
                        <div class="filter-form">
                            <input type="number" name="price_from" class="form-control price_from" placeholder=""/>
                            <span>-</span>
                            <input type="number" name="price_to" class="form-control price_to"/>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <p class="filter-title">Lọc theo diện tích: </p>
                        <div class="filter-form">
                            <input type="number" name="size_from" class="form-control size_from" placeholder=""/>
                            <span>-</span>
                            <input type="number" name="size_to" class="form-control size_to"/>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <p class="filter-title">Lọc theo ngày đăng: </p>
                        <div class="filter-form">
                            <input type="text" name="date_from" class="form-control datepicker date_from" placeholder=""/>
                            <span>-</span>
                            <input type="text" name="date_to" class="form-control datepicker date_to"/>
                        </div>
                    </div>
                    <div class="full-width sidebar-button text-center">
                        <button class="btn btn-default bt-filter">Áp dụng</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>

    </div>
</div>