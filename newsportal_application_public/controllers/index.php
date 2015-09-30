<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->load->model('News_model', '', TRUE);
	}
	
	public function index()
	{
		
        require_once APPPATH . 'php_include/authenticate.php';
	
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal';
		$data_msg['meta_description'] = 'News Portal';
		$data_msg['keywords'] = 'News Portal';
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'index';
		
		$get_all_news = $this->News_model->get_all_news(0, 10);
		if($get_all_news->num_rows > 0){
			$data_msg['all_news_details'] = $get_all_news->result_array();
		}
		
		$data_msg['total_news'] = $get_all_news->num_rows;		
		
		//--- start initializing an array to handle values and messages during error or success ---//        
        $initial_array = array(
            'error_msg' => '',
            'success_msg' => ''
        );
        //--- end initializing an array to handle values and messages during error or success ---//

		/* --- if error session is set start displaying error message, given values in input elements from the session & unset the session index --- */
        if($this->session->userdata('error_msg') != '') {			
            foreach ($initial_array as $key => $v) {
                // Collect message if it is in session...				
                if ($this->session->userdata($key) != '') {
                    $data_msg[$key] = $this->session->userdata($key);
                    $this->session->unset_userdata(array($key => ''));
                }
            }
        }
        /* --- end error manipulation --- */
  
        /* --- if success session is set display success message from the session & unset the session index -----  */
        if ($this->session->userdata('success_msg')) {

            $data_msg['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata(array('success_msg' => ''));
        }
        /* --- end showing success message --- */	
		
		$this->load->view('index/index', $data_msg);
	}
	
}

?>