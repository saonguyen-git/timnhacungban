<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function __construct()
    {
//        try {
//            $login = $_GET['login'];
//            if ($login != 0) {
//                $this->middleware('auth');
//            }
//        } catch (\Exception $e) {
//            $this->middleware('auth');
//        }
        $this->Link_price();
    }

    public function homePage()
    {
        $page = 1;
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        $limit = 10;
        $query = '';
        $url_current = url('/').'?';

        if(!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
            $min_price = $_GET['min_price'];
            $max_price = $_GET['max_price'];
            $query .= "AND price >= $min_price AND price <= $max_price";
            $url_current = url('/')."?min_price=$min_price&max_price=$max_price&";
        }

        $page_limit = ($page - 1) * $limit;
        $getDB = DB::select(DB::raw("SELECT * FROM nha_tro WHERE stt=1 ORDER BY created_at $query DESC LIMIT $page_limit, $limit"));
        $total = DB::select(DB::raw("SELECT COUNT(*) FROM nha_tro WHERE  stt=1 $query"));
        $total = $total[0]->{'COUNT(*)'};

        return view('home', ['total' => $total, 'current_page' => $page, 'value' => $getDB,'url_page'=>$url_current]);
    }

    public function Link_price()
    {
        $url_current = url()->full();

        if (!empty($_GET['min_price'])) {
            $min_price = $_GET['min_price'];
            $max_price = $_GET['max_price'];
            $url_price = str_replace("&min_price=$min_price&max_price=$max_price",'',$url_current);
            $url_price = str_replace("&max_price=$max_price&min_price=$min_price",'',$url_price);
        } else {
            //var_dump($url_current);
            if(strpos($url_current,'?') !== false){
                $url_price = $url_current.'&filter=price';
               // var_dump($url_current);
            }else{
                $url_price = $url_current.'?filter=price';
            }
        }
        view()->share(['url_price'=>$url_price]);
    }

    public function get_position(Request $request)
    {
        $type = $request->type;
        $value = $request->value;
        $db_result = '';
        if ($type == 'area') {
            $region_name = $this->get_region($value);
            $db_result = DB::select(DB::raw("SELECT * FROM table_area WHERE parent=N'$region_name'"));
        }
        if ($type == 'ward') {
            $area_name = $this->get_area($value);
            $db_result = DB::select(DB::raw("SELECT * FROM table_ward WHERE parent=N'$area_name'"));
        }
        return view('api.select-position', ['type' => $type, 'result' => $db_result]);
    }

    public function get_region($slug)
    {
        $db_region = DB::select(DB::raw("SELECT * FROM table_region WHERE slug = '$slug'"));
        $name_region = $db_region[0]->name;
        return $name_region;
    }

    public function get_area($slug)
    {
        $db_area = DB::select(DB::raw("SELECT * FROM table_area WHERE slug = '$slug'"));
        $name_area = $db_area[0]->name;
        return $name_area;
    }

    public function get_ward($slug)
    {
        $db_ward = DB::select(DB::raw("SELECT * FROM table_ward WHERE slug = '$slug'"));
        $name_ward = $db_ward[0]->name;
        return $name_ward;
    }

    public function get_detail($slug, $id)
    {
        $get_detail = DB::select(DB::raw("SELECT * FROM nha_tro WHERE id_product = '$id'"));
        if (!empty($get_detail)) {
            $area = $get_detail[0]->area_name;
            $ward_name = $get_detail[0]->ward_name;
            $get_relate = DB::select(DB::raw("SELECT * FROM nha_tro WHERE area_name = N'$area' ORDER BY `created_at` DESC LIMIT 0,12"));
            $get_ward = DB::select(DB::raw("SELECT * FROM nha_tro WHERE ward_name = N'$ward_name' ORDER BY `created_at` DESC LIMIT 0,10"));
            return view('detail', ['get_detail' => $get_detail[0], 'get_relate' => $get_relate, 'get_ward' => $get_ward]);
        } else {
            return view('page_404');
        }

    }

    public function get_post($id)
    {
        if ($id == 'ha-noi' || $id == 'tp-ho-chi-minh' || $id == 'da-nang') {

            $region_array = array('ha-noi' => 'Hà Nội', 'tp-ho-chi-minh' => 'Tp Hồ Chí Minh', 'da-nang' => 'Đà Nẵng');
            $region = $region_array[$id];

            $page = 1;
            if (!empty($_GET['page'])) {
                $page = $_GET['page'];
            }
            $limit = 10;
            $page_limit = ($page - 1) * $limit;

            $query = '';

            $position = $region;
            $root_url = url("/") . '/' . $id . '?status=1';
            $list_area = DB::select(DB::raw("SELECT * FROM table_area WHERE parent=N'$region'"));
            $list_ward = array();

            if (!empty($_GET['area_name'])) {
                $area = $_GET['area_name'];
                $select_area = DB::select(DB::raw("SELECT name FROM table_area WHERE slug = '$area' AND parent = N'$region' limit 0,1"));
                $area_name = $select_area[0]->name;
                $query .= " AND area_name = N'$area_name'";
                $position = $area_name;
                $root_url = $root_url . '&area_name=' . $area;
                $list_ward = DB::select(DB::raw("SELECT * FROM table_ward WHERE parent=N'$area_name'"));
                if (!empty($_GET['ward_name'])) {
                    $ward = $_GET['ward_name'];
                    $select_ward = DB::select(DB::raw("SELECT name FROM table_ward WHERE slug = '$ward' AND parent = N'$area_name' limit 0,1"));
                    $ward_name = $select_ward[0]->name;
                    $query .= " AND ward_name = N'$ward_name'";
                    $position = $ward_name . ', ' . $area_name . ', ' . $region;
                    $root_url = $root_url . '&ward_name=' . $ward;
                }
            }

            if(!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
                $min_price = $_GET['min_price'];
                $max_price = $_GET['max_price'];
                //var_dump($min_price);
                $query .= "AND price >= $min_price AND price <= $max_price";
                $root_url = $root_url."&min_price=$min_price&max_price=$max_price&";
            }

            $value_post = array(
                'list_area' => $list_area,
                'list_ward' => $list_ward
            );
            //var_dump($area_name);
            $get_post = DB::select(DB::raw("SELECT * FROM nha_tro WHERE region_name = N'$region' AND stt=1 $query ORDER BY `created_at` DESC LIMIT $page_limit, $limit"));
            //var_dump("SELECT * FROM nha_tro WHERE region_name = N'$region' AND stt=1 $query ORDER BY `created_at` DESC LIMIT $page_limit, $limit");
            $total = DB::select(DB::raw("SELECT COUNT(*) FROM nha_tro WHERE region_name = N'Hà Nội' $query"));
            $total = $total[0]->{'COUNT(*)'};

            return view('list-post', ['total' => $total, 'value_pos' => $value_post, 'position' => "Cho Thuê Phòng Trọ " . $position, 'region' => $id, 'current_page' => $page, 'value' => $get_post, 'root_url' => $root_url]);
        }else{
            return redirect('/');
        }
    }

    public function search()
    {
        $page = 1;
        if (!empty($_GET['page'])) {
            $page = $_GET['page'];
        }
        $limit = 10;
        $page_limit = ($page - 1) * $limit;
        $total = 0;
        $query = '';
        $text_title = "Không tìm thấy kết quả nào phù hợp";
        $root_url = url("/") . '/search';
        $search = array();
        $value_post = array();
        $region = '';
        $list_area = array();
        $list_ward = array();

        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $root_url = $root_url . '/?keyword=' . $keyword;
            if (!empty($_GET['region_name'])) {
                $region = $_GET['region_name'];
                $region_name = $this->get_region($region);
                $query .= "AND region_name = N'$region_name'";
                $list_area = DB::select(DB::raw("SELECT * FROM table_area WHERE parent=N'$region_name'"));
                $root_url .= '&region_name=' . $region;
            }
            if (!empty($_GET['area_name'])) {
                $area = $_GET['area_name'];
                $area_name = $this->get_area($area);
                $query .= "AND area_name = N'$area_name'";
                $list_ward = DB::select(DB::raw("SELECT * FROM table_ward WHERE parent=N'$area_name'"));
                $root_url .= "&area_name=$area";
            }
            if (!empty($_GET['ward_name'])) {
                $ward = $_GET['ward_name'];
                $ward_name = $this->get_ward($ward);
                $query .= "AND ward_name = N'$ward_name'";
                $root_url .= "&ward_name=$ward";
            }

            if (!empty($region_name) || !empty($area_name) || !empty($ward_name)) {
                $value_post = array(
                    'list_area' => $list_area,
                    'list_ward' => $list_ward
                );
            }

            $search = DB::select(DB::raw("SELECT * FROM nha_tro WHERE MATCH (title, body, category, address,ward_name, area_name,region_name) AGAINST ('$keyword' IN NATURAL LANGUAGE MODE) AND stt=1 $query ORDER BY `created_at` DESC limit $page_limit , $limit"));
            $count_total = DB::select(DB::raw("SELECT COUNT(*) FROM nha_tro WHERE MATCH (title, body, category, address,ward_name, area_name,region_name) AGAINST ('$keyword' IN NATURAL LANGUAGE MODE) AND stt=1 $query"));
            $total = $count_total[0]->{'COUNT(*)'};

            $text_title = "Tìm thấy " . number_format($total, 0, ",", ".") . " kết quả cho từ khóa: $keyword";
        }

        return view('list-post', ['total' => $total, 'value_pos' => $value_post, 'keyword' => $keyword, 'region' => $region, 'position' => $text_title, 'current_page' => $page, 'value' => $search, 'root_url' => $root_url]);
    }
}
