<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->load->model('User_model', '', TRUE);
	}
	
	/********* User Sign Up *********/
	public function signup(){
			
        require_once APPPATH . 'php_include/authenticate.php';
		
		// if user is already logged in, redirect to home....
        if (isset($login_nwp_user_id) && $login_nwp_user_id != '0') {
            redirect(base_url());
            exit;
        }
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: Registration';
        $data_msg['meta_description'] = 'News Portal';
		$data_msg['keywords'] = 'News Portal';
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'signup';

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
		
		if ($this->input->post('btn_submit')) {
			//print_r($this->input->post()); die();
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$this->form_validation->set_rules('user_name', 'Full Name', 'required|min_length[3]');
			// Validation For Email Field
			$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
			
			if($this->form_validation->run() == FALSE){
				$this->load->view('user/signup', $data_msg);
			}else{
				$user_name = trim(strip_tags($this->input->post('user_name')));
				$user_email = trim(strip_tags($this->input->post('user_email')));
				
				$email_exist_num = $this->User_model->email_exist($user_email);
				
				if ($email_exist_num > 0) {
					$error_msg = 'This email id is already exist in our site. Please login.';
				}else{
					$error_msg = '';
				}
				
				//--- set error message into session if @error_msg is defined ---//
				if(isset($error_msg) && $error_msg != ''){
					$sess_array = array();
	
					foreach ($initial_array as $key => $v) {
						// Collect input value if it is defined...
						if (isset($$key)) {
							$sess_array[$key] = $$key;
						}
					}
					$this->session->set_userdata($sess_array);	
				}
				//--- else set DB operations on success, corresponding success message ---//
				else{
					
					$user_id = $this->all_function->rand_string(8);
					
					$insert_fields = array(
										'UserID' => $user_id,
										'UserEmail' => $user_email,
										'UserFullName' => $user_name,
										'IPAddress' => getenv('REMOTE_ADDR'),
										'Status' => '0',
										'JoinDate' => date("Y-m-d H:i:s")
									);
	
					$this->User_model->insert_user_details($insert_fields);
					
					/***** Send Email With Activation Link To User *******/
					$link = base_url() . 'account-activate/' . base64_encode($user_id);
					$activation_link = '<a href="' . $link . '" style="color:#025F79;">'.$link.'</a>';
					
					$email_subject = 'Thank You for your registration';
					
					$email_content = '<p>Hi '.$user_name.',</p>';
					$email_content .= '<p>Thank You for your registration. Please click the confirmation link below or directly paste the link on the browser. And the add new paasword to activate your account.</p>';
					$email_content .= '<p>Activation Link: '.$activation_link.'</p>';
					$email_content .= '<p>Thanks,</p>';
					$email_content .= '<p>'.SITE_NAME.' Team</p>';
					//echo $email_content; die;
					
					$mail_config = array(
								  'mailtype' => 'html',
								  'charset' => 'iso-8859-1',
								  'wordwrap' => TRUE
								);
					
					$this->load->library('email', $mail_config);
					//$this->email->clear();
					$this->email->to($user_email);
					$this->email->from(NO_REPLY_EMAIL, SITE_NAME);
					$this->email->subject($email_subject);
					$this->email->message($email_content);
					$this->email->send();
					/***** Send Email With Activation Link To User *******/
					
					$this->session->set_userdata('success_msg', 'Thank You for your registration. Please check your email then click the confirmation link and add new paasword to activate your account.');
				}				
				
				redirect(base_url().'signup');
				exit;
			}
			
		}
		
		$this->load->view('user/signup', $data_msg);
	}
	
	/********* User Activate Account *********/
	public function account_activate($activation_id){
		
        require_once APPPATH . 'php_include/authenticate.php';
		
		// if user is already logged in, redirect to home....
        if (isset($login_nwp_user_id) && $login_nwp_user_id != '0') {
            redirect(base_url());
            exit;
        }
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: Account Activation';
        $data_msg['meta_description'] = 'Account Activation';
		$data_msg['keywords'] = 'Account Activation';
        //----- start meta content -----//
		
		$data_msg['activation_id'] = $activation_id;
		
		$user_id = base64_decode($activation_id);
		
		$get_user_inactive_status = $this->User_model->get_user_inactive_status($user_id);
		
		if($get_user_inactive_status->num_rows == 0){
			$error_msg = 'This activation link is not valid. The user is either deleted or already activated.';
			$this->session->set_userdata('error_msg', $error_msg);
			redirect(base_url().'signup');
			exit;
		}
		
		if ($this->input->post('btn_submit')) {
			//print_r($this->input->post()); die();
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			$this->form_validation->set_rules('user_password', 'New Password', 'required|min_length[5]|matches[confirm_password]');
			// Validation For Email Field
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			
			if($this->form_validation->run() == FALSE){
				$this->load->view('user/account-activate', $data_msg);
			}else{
				$user_password = trim(strip_tags($this->input->post('user_password')));
				
				$update_fields = array(
									'UserPassword' => md5($user_password),
									'IPAddress' => getenv('REMOTE_ADDR'),
									'Status' => '1',
									'UpdateDate' => date("Y-m-d H:i:s")
								);
						
				$this->User_model->update_user_details($user_id, $update_fields);
				
				$success_msg = 'Your account successfully activated. Please login now.';
				$this->session->set_userdata('success_msg', $success_msg);
				redirect(base_url());
				exit;
			}
		}
		
		$this->load->view('user/account-activate', $data_msg);
	}
	
	/********* User Log In *********/
	public function login(){		
		
        require_once APPPATH . 'php_include/authenticate.php';
		
		// if user is already logged in, redirect to home....
        if (isset($login_nwp_user_id) && $login_nwp_user_id != '0') {
            redirect(base_url());
            exit;
        }

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
		
		if ($this->input->post('btn_submit')) {
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
			
			// Validation For Email Field
			$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('user_password', 'Password', 'required');
			
			if($this->form_validation->run() == FALSE){
				$this->load->view('user/signup', $data_msg);
			}else{
				
				$user_email = trim(strip_tags($this->input->post('user_email')));
				$user_password = trim(strip_tags($this->input->post('user_password')));
				
				$check_user_login = $this->User_model->check_user_login($user_email, md5($user_password));
								
				if($check_user_login->num_rows == 0){
					$error_msg = 'Your login email/password does not match. Please try again.';
				}else{
					$error_msg = '';
				}
				
				//--- set error message into session if @error_msg is defined ---//
				if(isset($error_msg) && $error_msg != ''){
					$sess_array = array();
	
					foreach ($initial_array as $key => $v) {
						// Collect input value if it is defined...
						if (isset($$key)) {
							$sess_array[$key] = $$key;
						}
					}
					$this->session->set_userdata($sess_array);
				}
				//--- else set DB operations on success, corresponding success message ---//
				else{
					$user_details = $check_user_login->result_array();
					
					$user_id = $user_details[0]['UserID'];
					$user_email = $user_details[0]['UserEmail'];
					$user_fullname = $user_details[0]['UserFullName'];
					
					$UserLogId = SITE_CODE.$this->all_function->rand_string(8);
					$insert_fields = array(
										'UserLogID' => $UserLogId,
										'UserID' => $user_id,
										//'LogInTime' => date('Y-m-d H:i:s'),
										'IPAddress' => $_SERVER['REMOTE_ADDR']
									);

					$this->User_model->insert_user_login($insert_fields);
					
					$this->session->set_userdata(array('login_'.SITE_CODE.'_user_id' => $user_id, 'login_'.SITE_CODE.'_user_fullname' => $user_fullname, 'login_'.SITE_CODE.'_user_email' => $user_email, 'current_user_logid' => $UserLogId));
					
					$this->session->set_userdata('success_msg', 'You are successfully logged in.');
				}				
				
				redirect(base_url().'my-news');
				exit;
			}
			
		}
	}
	
	/********* User Sign Out *********/
    public function signout() {
        require_once APPPATH . 'php_include/authenticate.php';
		
        if ($login_nwp_user_id != '0') {
			$last_login = $this->User_model->last_user_login($login_nwp_user_id);			
			
			$this->User_model->update_user_login($current_user_logid, $last_login);
				
            $this->session->unset_userdata(array('login_'.SITE_CODE.'_user_id' => '', 'login_'.SITE_CODE.'_user_fullname' => '', 'login_'.SITE_CODE.'_user_email' => '', 'current_user_logid' => ''));
			//$this->session->sess_destroy();

        }

		redirect(base_url());
    }
}

?>