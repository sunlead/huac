<?php

/**
 * 字符串是否为纯数字
 * @param unknown_type $num
 * @return boolean
 */
function isnum($num){

    $alb= array('0','1','2','3','4','5','6','7','8','9');

    if(strlen($num)<1){
        return false;
    }
    for ($i=0;$i<strlen($num);$i++){
        if(!in_array(substr($num,$i,1),$alb)){
            return false;
        }
    }
    return true;
}

//去掉空格
$str = trim('20578019216800000677');
$code_len = strlen($str);
//绑定码长度
$ver = substr($str, 0, 1);
//版本号
if (isnum($str)) {
    switch ($ver) {

        case 1 :
        case 2 :
            //非魔云
            $company_code = substr($str, 1, 5);
            if ($code_len == 14) {
            
                $ip_0 = substr($str, 6, 3);
                $ip_1 = substr($str, 9, 3);
            
                if (intval($ip_0) < 255 && intval($ip_1) < 255 && intval($ip_1) > 0) {
            
                    $stb_ip = '192.168.' . intval($ip_0) . '.' . intval($ip_1);
            
                    return array('bar_code' => $str, 'company_code' => $company_code, 'stb_ip' => $stb_ip);
                }
            } else if ($code_len == 20) {
            
                $ip_0 = substr($str, 6, 3);
                $ip_1 = substr($str, 9, 3);
                $ip_2 = substr($str, 12, 3);
                $ip_3 = substr($str, 15, 3);
            
                if (intval($ip_0) < 255 && intval($ip_1) < 255 && intval($ip_2) < 255 && intval($ip_3) < 255) {
            
                    $stb_ip = intval($ip_0) . '.' . intval($ip_1) . '.' . intval($ip_2) . '.' . intval($ip_3);
            
                    echo 'bar_code:'. $str.';company_code:'.$company_code.';stb_ip:'.$stb_ip;
                }
            }
        case 3 :
            //版本号3
            if ($code_len == 22) {

                $net_symbol = substr($str, 1, 1);
                //联网标志
                $net_protocol = substr($str, 2, 1);
                //网络协议

                $company_code = substr($str, 3, 5);

                $ip_0 = substr($str, 8, 3);
                $ip_1 = substr($str, 11, 3);
                $ip_2 = substr($str, 14, 3);
                $ip_3 = substr($str, 17, 3);


                if (intval($ip_0) < 255 && intval($ip_1) < 255 && intval($ip_2) < 255 && intval($ip_3) < 255) {

                    $stb_ip = intval($ip_0) . '.' . intval($ip_1) . '.' . intval($ip_2) . '.' . intval($ip_3);

                    echo 'bar_code:'. $str.';company_code:'.$company_code.';stb_ip:'.$stb_ip;
                }
            }
            break;
    }
}
