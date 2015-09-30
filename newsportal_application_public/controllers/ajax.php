<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		//$this->load->model('Property_model', '', TRUE);
	}
	
	/********* Check User Availability **********/
	public function ajax_check_email_avilability(){
		if ($this->input->is_ajax_request() == TRUE) {
			$this->load->model('User_model', '', TRUE);
			
			$user_email = $this->input->post('user_email');
			$data = array();
			
			$email_exist_num = $this->User_model->email_exist($user_email);
			if ($email_exist_num > 0) {
				$data['ErrorCode'] = 1;
			}else{
				$data['ErrorCode'] = 0;
			}
			
			die(json_encode($data));
		}else {
            redirect(base_url());
        }
	}
	
	/********* Delete User News **********/
	public function ajax_delete_news(){
		if ($this->input->is_ajax_request() == TRUE) {
			require_once APPPATH . 'php_include/authenticate.php';
			
			$data = array();
			
			if (isset($login_nwp_user_id) && $login_nwp_user_id != '0') {
				$this->load->model('News_model', '', TRUE);
				
				$news_id = $this->input->post('news_id');
				
				$get_news_details = $this->News_model->get_news_details($news_id, $login_nwp_user_id);
				
				if($get_news_details->num_rows > 0){
					$update_fields = array(
									'IPAddress' => getenv('REMOTE_ADDR'),
									'Status' => '3',
									'UpdateDate' => date("Y-m-d H:i:s")
								);
					
					$this->News_model->update_news_details($news_id, $update_fields);
					
					$data['ErrorCode'] = 0;
					$data['Message'] = 'News deleted successfully';
				}else{
					$data['ErrorCode'] = 1;
					$data['Message'] = 'Sorry! You are not the author of the news';
				}
				
			}else{
				$data['ErrorCode'] = 1;
				$data['Message'] = 'Please login before delete any news';
			}
			
			die(json_encode($data));
		}else {
            redirect(base_url());
        }
	}
}

?>