<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function segment($uri = 1) {
    $lmp = & get_instance();
    return $lmp->uri->segment($uri);
}

if (!function_exists('dimention')) {

    function dimention() {
        $array = array(
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

?>