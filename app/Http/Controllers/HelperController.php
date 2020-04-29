<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HelperController extends Controller
{
    //
    public function httprequest($url, $method, $timeout = 30, $header = array(), $proxy = array(), $filter = array()){
		$curl = curl_init();
		//print_r($filter);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => $timeout,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			//CURLOPT_POSTFIELDS => $body,
			CURLOPT_FOLLOWLOCATION => true,

			// CURLOPT_PROXYTYPE => 7,
			// CURLOPT_PROXY => "195.201.192.254",
			// CURLOPT_PROXYPORT => "28982"
		));
		if(!empty($filter)){
			if(isset($filter['file'])){
				$file = $filter['file'];
				curl_setopt($curl, CURLOPT_COOKIEJAR, $file);
				curl_setopt($curl, CURLOPT_COOKIEFILE, $file);
			}
			if($filter['statuscode'] == true){
				curl_setopt($curl, CURLOPT_HEADER  , true);  // we want headers
				curl_setopt($curl, CURLOPT_NOBODY  , true);
			}
		}
		if($method == 'POST'){
			curl_setopt($curl, CURLOPT_POSTFIELDS, $filter['body']);
		}
		if(!empty($proxy)){
			if(!isset($proxy['type'])){
				curl_setopt($curl, CURLOPT_PROXYTYPE, 7);
			} else {
				if($type = 'http'){
					curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    				//$tmp_type = CURLPROXY_HTTP;
	    		} elseif($type == 'socks5'){
	    			curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	    			//$tmp_type = CURLPROXY_SOCKS5;
	    		} elseif($type == 'socks4'){
	    			curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
	    			//$tmp_type = CURLPROXY_SOCKS4;
	    		}
				//curl_setopt($curl, CURLOPT_PROXYTYPE, $proxy['type']);
			}
			curl_setopt($curl, CURLOPT_PROXY, $proxy['host']);
			curl_setopt($curl, CURLOPT_PROXYPORT, $proxy['port']);
		}
		if(!empty($header)){
			$params = array();
			foreach ($header as $key => $value) {
				$params[] = $key.":".$value;
			}
			curl_setopt($curl, CURLOPT_HTTPHEADER, $params);
		}
		// if($xmlRequest !== false){
		// 	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest","content-length: ".strlen($body),
		// "content-type: application/x-www-form-urlencoded; charset=UTF-8","referer: ".$referer,'x-csrf-token:'.$token));
		// }
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		if($err){
			$res = array('status' => false, 'err' => $err);
			return $res;
		}
		if(!empty($filter)){
			if(isset($filter['statuscode']) && $filter['statuscode'] == true){
				$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
				$res = array('status' => true,'msg' => $httpcode);
				return $res;
			}
		}
		curl_close($curl);
		return $res = array('status' => true,'msg' => $response);
	}
	public function getUserAgent(){
    	$info = DB::table('user_agent_list')->where('status',0)->first();
    	if(!$info){
    		DB::table('user_agent_list')->update(['status' => 0]);
    		$info = DB::table('user_agent_list')->where('status',0)->first();
    	} 
    	DB::table('user_agent_list')->where('id', $info->id)->update(['status' => 1]);
    	return $info->user_agent;
    }
    public function log($error, $file){
    	file_put_contents($file, $error.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    public function multiHttpRequest($list, $useTor = 0){
		$mh = curl_multi_init();
		$res = array();
		foreach ($list as $kk => $item) {
			$url = $item['url'];
			$method = $item['method'];
			$timeout = $item['timeout'];
			$curl[$kk] = curl_init();
			//echo $url.PHP_EOL;
			curl_setopt_array($curl[$kk], array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => $timeout,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => $method,
				//CURLOPT_POSTFIELDS => $body,
				CURLOPT_FOLLOWLOCATION => true,
				//CURLOPT_AUTOREFERER => true,
				//CURLOPT_COOKIESESSION => true
				// CURLOPT_PROXYTYPE => 7,
				// CURLOPT_PROXY => "195.201.192.254",
				// CURLOPT_PROXYPORT => "28982"
			));
			if($useTor == 1){
				curl_setopt($curl[$kk], CURLOPT_PROXY, 'http://localhost:9050');
		    	curl_setopt($curl[$kk], CURLOPT_PROXYTYPE, 7);
			}
			$header = $item['header'];
			if(!empty($header)){
				$params = array();
				foreach ($header as $key => $value) {
					$params[] = $key.":".$value;
				}
				curl_setopt($curl[$kk], CURLOPT_HTTPHEADER, $params);
			}
			curl_multi_add_handle($mh,$curl[$kk]);
			
		}
		// Start performing the request\
	    $runningHandles = null;
	    do {
	      $execReturnValue = curl_multi_exec($mh, $runningHandles);
	    } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);

	    // Loop and continue processing the request
	    while ($runningHandles && $execReturnValue == CURLM_OK) {

	      // !!!!! changed this if and the next do-while !!!!!

	      if (curl_multi_select($mh) != -1) {
	        usleep(100);
	      }

	      do {
	        $execReturnValue = curl_multi_exec($mh, $runningHandles);
	      } while ($execReturnValue == CURLM_CALL_MULTI_PERFORM);

	    }

	    // Check for any errors
	    if ($execReturnValue != CURLM_OK) {
	      trigger_error("Curl multi read error $execReturnValue\n", E_USER_WARNING);
	    }

	    // Extract the content
	    foreach($list as $i => $url)
	    {
	      // Check for errors
	      $curlError = curl_error($curl[$i]);
	      if($curlError == "") {
	        $res[$i] = curl_multi_getcontent($curl[$i]);
	      } else {
	        print "Curl error on handle $i: $curlError\n";
	      }
	      // Remove and close the handle
	      curl_multi_remove_handle($mh, $curl[$i]);
	      curl_close($curl[$i]);
	    }
	    // Clean up the curl_multi handle
	    curl_multi_close($mh);
	    return $res;
	}
	public function getDom($html){
		include 'simple_html_dom.php';
		return str_get_html($html);
	}
}
