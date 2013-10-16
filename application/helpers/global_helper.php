<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('segment')) {
	function segment($uri = 1) {
	    $lmp = & get_instance();
	    return $lmp->uri->segment($uri);
	}

function formatMoney($number, $fractional = false,$currency=NULL) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    if($currency != NULL){
        $number .= " ".$currency;
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

}
if (!function_exists('dimention')) {

    function dimention() {
        $array = array(
            ''=>DROPDOWN_DEFAULT,
            'x10&#x2079;/1'=>'x10&#x2079;/1',
            'x10&#x2081;&#x2082;/1'=>'x10&#x2081;&#x2082;/1',
            'g/dl'=>'g/dl',
            'fl'=>'fl',
            'pg'=>'pg',
            '%'=>'%',
            'mm'=>'mm',
        );
        return $array;
    }
}
if (!function_exists('string_digit')) {
    function string_digit($digit) {
        $format = '0000000';
		return substr($format, 0,-strlen($digit)).$digit;
    }
}

?>