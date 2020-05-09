<?php

namespace App\Http\Controllers;
include 'simple_html_dom.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

ini_set('memory_limit', -1);

class GetDataChototController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }
    public function GetDataJob($page, $region){

    }
    public function GetData($page, $region)
    {
        $url = "https://gateway.chotot.com/v1/public/ad-listing?region_v2=$region&cg=1050&limit=20&st=u,h&page=$page";
        $result = $this->cUrl($url);

        if (!empty($result)) {
            $json_rs = $result;
            $json_rs = json_encode($json_rs);
            $json_rs = json_decode($json_rs);

            foreach ($json_rs->ads as $json) {
                try {
                    $id_product = $json->list_id;
                    $title = $json->subject;
                    $title = str_replace("'", '', $title);
                    $slug_title = $this->convert_name($title);
                    $slug = strtolower($slug_title);
                    $slug = str_replace('/', '-', $slug);

                    $body = '';
                    if (!empty($json->{'body'})) {
                        $body = $json->{'body'};
                    }

                    $category = $json->category_name;
                    if (!empty($json->price)) {
                        $price = $json->price;
                    } else {
                        $price = 0;
                    }
                    $account_name = $json->account_name;
                    $check_product = DB::select(DB::raw("SELECT COUNT(*) FROM nha_tro WHERE id_product = '$id_product'"));

                    if (!empty($check_product[0]->{'COUNT(*)'})) {
                        var_dump('Product exist');
                    } else {
                        $url_info = "https://gateway.chotot.com/v1/public/ad-listing/$id_product";
                        $get_info = $this->cUrl($url_info);
                        if (!empty($get_info)) {

                            $info = $get_info;
                            $info = json_encode($info);
                            $info = json_decode($info);
                            $info = $info->ad;
                            $phone = $info->phone;
                            $size = '';
                            if (!empty($info->size)) {
                                $size = $info->size;
                            }

                            if (!empty($info->thumbnail_image)) {
                                $thumbnail = $info->thumbnail_image;
                                $slide = $info->images;
                                $slide = implode(',', $slide);
                            } else {
                                $thumbnail = '';
                                $slide = '';
                            }
                            if (!empty($info->address)) {
                                $address = $info->address;
                            } else {
                                $address = '';
                            }
                            $ward_name = '';
                            if (!empty($info->ward_name)) {
                                $ward_name = $info->ward_name;
                            }
                            $area_name = $info->area_name;
                            $region_name = $info->region_name;
                            $website = 'chotot.com';
                            $created_at = date('Y/m/d H:i:s', str_replace(substr($info->list_time, -3), '', $info->list_time));

                            DB::table("nha_tro")->updateOrInsert([
                                'id_product' => $id_product,
                                'title' => $title,
                                'slug' => $slug,
                                'body' => $body,
                                'category' => $category,
                                'price' => $price,
                                'phone' => $phone,
                                'account_name' => $account_name,
                                'size' => $size,
                                'thumbnail' => $thumbnail,
                                'slide' => $slide,
                                'address' => $address,
                                'ward_name' => $ward_name,
                                'area_name' => $area_name,
                                'region_name' => $region_name,
                                'website' => $website,
                                'created_at' => $created_at
                            ]);

                            var_dump("Insert $id_product db success full");
                        }
                    }
                } catch (\Exception $exception) {
                    file_put_contents(public_path('/json-product.txt'), json_encode($json_rs->ads));
                }
            }
            file_put_contents(public_path("/$region.txt"), $page);
            var_dump('next page' . ($page + 1));
        } else {
            var_dump('mission false');
            var_dump($result);
            die();
        }
    }



    public function GetDataMuaBan($page, $region)
    {
        $website = 'muaban.net';
        if ($region == 1) {
            $url = "https://muaban.net/nha-tro-phong-tro-ha-noi-l24-c3405?cp=$page";
            $region_name = 'Hà Nội';
        }
        if ($region == 2) {
            $url = "https://muaban.net/nha-tro-phong-tro-ho-chi-minh-l59-c3405?cp=$page";
            $region_name = 'Tp Hồ Chí Minh';
        }
        $result = $this->helper->httprequest($url, "GET");
        //var_dump($result);
        if (!empty($result)) {
            $html = str_get_html($result['msg']);
            $list_item = $html->find("#list-box .list-item-container");
            foreach ($list_item as $item) {
                $link = $item->find('a.list-item__link', 0)->href;

                $id = explode('-id', $link);
                $id_post = $id[1];
                $id_product = "id$id_post";

                $check_product = DB::select(DB::raw("SELECT COUNT(*) FROM nha_tro WHERE id_product = '$id_product'"));

                if (!empty($check_product[0]->{'COUNT(*)'})) {
                    var_dump('Product exist');
                } else {
                    var_dump($link);
                    $detail = $this->helper->httprequest($link, "GET");

                    $html_detail = str_get_html($detail['msg']);

                    $title = $html_detail->find('.detail-container__left h1.title', 0)->innertext;
                    $title = trim($title);

                    $slug_title = $this->convert_name($title);
                    $slug = strtolower($slug_title);
                    $slug = str_replace('/', '-', $slug);
                    $body = $html_detail->find('.body-container', 0)->plaintext;
                    $body = trim($body);
                    $category = "Phòng trọ";
                    $price = 0;
                    if(!empty($html_detail->find('.price-container__value', 0))){
                        $div_price = $html_detail->find('.price-container__value', 0)->plaintext;
                        $price = str_replace('.', '', $div_price);
                        $price = str_replace('đ', '', $price);
                        $price = trim($price);
                    }

                    $account_name = $html_detail->find('.user-info__fullname', 0)->plaintext;
                    $account_name = trim($account_name);
                    $size=0;
                    if(!empty($html_detail->find('.tect-content-block .tech-item .tech-item__value', 0))) {
                        $size = $html_detail->find('.tect-content-block .tech-item .tech-item__value', 0)->plaintext;
                        $size = str_replace('m²', '', $size);
                        $size = trim($size);
                    }
                    $thumbnail = '';
                    $slide = '';

                    $address = '';
                    if(!empty($html_detail->find('.tect-content-block .tech-item .tech-item__long-value', 0))) {
                        $address = $html_detail->find('.tect-content-block .tech-item .tech-item__long-value', 0)->plaintext;
                        $address = trim($address);
                    }

                    $ward_name = '';

                    $area_name = $html_detail->find('.location-clock__location', 0)->plaintext;
                    $area_name = trim($area_name);
                    $area_name = str_replace('- ' . $region_name, '', $area_name);
                    $area_name = trim($area_name);

                    $created_at = $html_detail->find('.location-clock__clock', 0)->plaintext;
                    $created_at = date('Y/m/d H:i:s', strtotime($created_at));

                    if(!empty($html_detail->find('.mobile-container__value span', 0))){
                        $phone = $html_detail->find('.mobile-container__value span', 0)->attr['mobile'];

                        DB::table("nha_tro")->updateOrInsert([
                            'id_product' => $id_product,
                            'title' => $title,
                            'slug' => $slug,
                            'body' => $body,
                            'category' => $category,
                            'price' => $price,
                            'phone' => $phone,
                            'account_name' => $account_name,
                            'size' => $size,
                            'thumbnail' => $thumbnail,
                            'slide' => $slide,
                            'address' => $address,
                            'ward_name' => $ward_name,
                            'area_name' => $area_name,
                            'region_name' => $region_name,
                            'website' => $website,
                            'created_at' => $created_at
                        ]);
                    }

                    var_dump("Insert $id_product db success full");
                }
            }
        }
    }

    public function get_page()
    {
        $db_page = DB::select(DB::raw("SELECT id,page_number FROM page_chotot WHERE checked = 0 AND website = 1 limit 0,1"));
        if (!empty($db_page)) {
            $page = $db_page[0]->page_number;
            $id_page = $db_page[0]->id;
            return array('page_number' => $page, 'page_id' => $id_page);
        } else {
            DB::table('page_chotot')->where('checked', 1)->update(['checked' => 0]);
            $this->get_page();
        }
    }

    function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }

    // hàm chuyển từ string sang slug
    public function str_to_slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function get_position()
    {
        $json_file = file_get_contents(public_path('/json_data.txt'));
        $json_file = json_decode($json_file);

        foreach ($json_file as $item_region) {
            $name_region = $item_region->name;
            $slug_region = $this->convert_name($name_region);
            $slug_region = strtolower($slug_region);
            $check_region = DB::select(DB::raw("SELECT * FROM table_region WHERE name= N'$name_region'"));
            if (!empty($check_region)) {
                var_dump("Region $name_region is exist");
            } else {
                DB::table('table_region')->insertOrIgnore(['name' => $name_region, 'slug' => $slug_region]);
                var_dump("Insert region $name_region success");
            }

            $list_area = $item_region->area;

            foreach ($list_area as $item_area) {
                $code = $item_area->id;
                $name_area = $item_area->name;
                $slug_area = $item_area->name_url;
                $check_area = DB::select(DB::raw("SELECT * FROM table_area WHERE name= N'$name_area'"));
                if (!empty($check_area)) {
                    var_dump("Area $name_area is exist");
                } else {
                    DB::table('table_area')->insertOrIgnore(['name' => $name_area, 'slug' => $slug_area, 'code' => $code, 'parent' => $name_region]);
                    var_dump("Insert area $name_area success");
                }
            }

            var_dump("$name_region Done");
        }
    }

    public function get_ward()
    {
        $select_area = DB::select(DB::raw("SELECT * FROM table_area"));
        foreach ($select_area as $item_area) {
            $name_area = $item_area->name;
            $code_area = $item_area->code;
            $url_api = "https://gateway.chotot.com/v2/public/chapy-pro/wards?area=$code_area";
            $get_api = $this->helper->httprequest($url_api, "GET");
            if (!empty($get_api['msg'])) {
                $msg = $get_api['msg'];
                $json = json_decode($msg);
                $list_wards = $json->wards;
                foreach ($list_wards as $item_ward) {
                    $name_ward = $item_ward->name;
                    $slug_ward = $this->convert_name($name_ward);
                    $slug_ward = strtolower($slug_ward);
                    $check_ward = DB::select(DB::raw("SELECT * FROM table_ward WHERE name= N'$name_ward' AND parent = N'$name_area'"));
                    if (!empty($check_ward)) {
                        var_dump("Ward $name_ward is exist");
                    } else {
                        DB::table('table_ward')->insertOrIgnore(['name' => $name_ward, 'slug' => $slug_ward, 'parent' => $name_area]);
                        var_dump("Insert area $name_ward success");
                    }
                }
            }
        }
    }

    public function get_user_agent()
    {
        $db = DB::select("SELECT * FROM user_agent_list WHERE status != 404 and checked = 0 limit 0, 1");
        if (!empty($db)) {
            $user_agent = $db[0]->user_agent;
            $id = $db[0]->id;
            $list_key = array('android', 'iphone', 'ios', 'mobile');
            $low_useragent = strtolower($user_agent);
            $checked = 0;
            foreach ($list_key as $key) {
                if (strpos($low_useragent, $key)) {
                    $checked = 1;
                }
            }
            if ($checked == 1) {
                DB::table('user_agent_list')->where('user_agent', $user_agent)->update(['checked' => 2]);
                var_dump('mobile');
                var_dump($user_agent);
                $this->get_user_agent();
            }
            DB::select(DB::raw("UPDATE user_agent_list set checked = 1 WHERE id = $id"));
            return $user_agent;
        } else {
            DB::select(DB::raw("UPDATE user_agent_list set checked = 0 WHERE checked = 1"));
            sleep(2);
            $this->get_user_agent();
        }
    }

    public function cUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        $value = json_decode(json_encode($data), true);

        return $value;
    }

}
