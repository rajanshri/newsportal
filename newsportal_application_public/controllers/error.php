<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Error extends CI_Controller {
 
	function __construct() {
		parent::__construct();

	}
    
	function page_missing(){
        // if user is already logged in, redirect to home....
        require_once APPPATH . 'php_include/authenticate.php';
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: 404 Error';
		$data_msg['meta_description'] = '404 Error';
		$data_msg['keywords'] = '404 Error';
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'error';
		
		$this->load->view('error/404-page', $data_msg);
	}
}
?>