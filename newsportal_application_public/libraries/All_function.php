<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_function {

    function __construct() {
        
    }
	
     /*
     * this function generates a random string. Basically used for auto-generated ids.
     */
	 function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        $time = mktime();
        $val = $time . $rand;

        return $val;
    }

    /*
     * this function fetches the latest top news
     */
	function get_top_news_details($limit_from = null, $total_row_display = null) {
        $CI = & get_instance();

        $CI->load->model('News_model', '', TRUE);

        $val = $CI->News_model->get_all_news($limit_from = null, $total_row_display = null);

        if ($val->num_rows == 0) {
            return "";
        } else {
            $result = $val->result_array();           

            return $result;
        }
    }
    
}

?>