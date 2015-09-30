<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct(){
		parent:: __construct();
		
		$this->load->model('News_model', '', TRUE);
	}
	
	/*************** News Details **************/
	public function news_details($news_id){
		
        require_once APPPATH . 'php_include/authenticate.php';
				
		$get_news_details = $this->News_model->get_news_details($news_id);
		
		if($get_news_details->num_rows == 0){
			redirect(base_url());
            exit;
		}else{
			$site_news_details = $get_news_details->result_array();
			//print_r($site_news_details);
			$news_id = $site_news_details[0]['NewsID'];
			$news_user_id = $site_news_details[0]['UserID'];
			$news_user_full_name = $site_news_details[0]['UserFullName'];
			$news_user_email = $site_news_details[0]['UserEmail'];
			$news_title = $site_news_details[0]['NewsTitle'];
			$news_details = $site_news_details[0]['NewsDetails'];
			$news_image = $site_news_details[0]['NewsImage'];
			$news_thumb_image = $site_news_details[0]['NewsImageThumb'];
			$news_add_date = $site_news_details[0]['AddDate'];
			
		}
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: '.$news_title;
		$data_msg['meta_description'] = $news_title;
		$data_msg['keywords'] = $news_title;
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'news';
		
		$data_msg['news_id'] = $news_id;
		$data_msg['news_user_id'] = $news_user_id;
		$data_msg['news_user_full_name'] = $news_user_full_name;
		$data_msg['news_user_email'] = $news_user_email;
		$data_msg['news_title'] = $news_title;
		$data_msg['news_details'] = $news_details;
		$data_msg['news_image'] = $news_image;
		$data_msg['news_thumb_image'] = $news_thumb_image;
		$data_msg['news_add_date'] = $news_add_date;
		
		$this->load->view('news/news-details', $data_msg);
	}
	
	/*************** Download News Details PDF **************/
	public function news_pdf_download($news_id){
		
        require_once APPPATH . 'php_include/authenticate.php';
		
		// Load Pdf library
		$this->load->library('dompdf_gen');
		
		$get_news_details = $this->News_model->get_news_details($news_id);
		
		if($get_news_details->num_rows == 0){
			redirect(base_url());
            exit;
		}else{
			$site_news_details = $get_news_details->result_array();
			//print_r($site_news_details);
			$news_id = $site_news_details[0]['NewsID'];
			$news_user_id = $site_news_details[0]['UserID'];
			$news_user_full_name = $site_news_details[0]['UserFullName'];
			$news_user_email = $site_news_details[0]['UserEmail'];
			$news_title = $site_news_details[0]['NewsTitle'];
			$news_details = $site_news_details[0]['NewsDetails'];
			$news_image = $site_news_details[0]['NewsImage'];
			$news_thumb_image = $site_news_details[0]['NewsImageThumb'];
			$news_add_date = $site_news_details[0]['AddDate'];
			$pdf_news_title = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $news_title)));
		}
		
		
		$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="en">';
		$html .= '<head>';
		$html .= '<title>News Portal :: '.$news_title.'</title>';
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		$html .= '<link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css">';
		$html .= '<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />';
		$html .= '<link href="css/pgwslider.css" rel="stylesheet">';
		$html .= '<link rel="stylesheet" href="css/font-awesome.min.css">';
		$html .= '<link href="style.css" rel="stylesheet" media="screen">';	
		$html .= '<link href="responsive.css" rel="stylesheet" media="screen">';		
		$html .= '</head>';
		
		$html .= '<body>';
		$html .= '<section id="content_area">';
		$html .= '<div class="clearfix wrapper main_content_area">';
		$html .= '<div class="clearfix main_content floatleft">';
		$html .= '<div class="clearfix content">';
		$html .= '<div class="content_title2"><h2>'.$news_title.'</h2></div>';
		$html .= '<div class="single_work_page clearfix">';
		$html .= '<div class="work_single_page_feature"><img src="'.NEWS_IMAGE_UPLOAD_PATH.$news_image.'"/></div>';
		$html .= '<div class="work_meta clearfix">';
		$html .= '<p class="floatleft">Dated : <span> '.date('j F Y', strtotime($news_add_date)).'</span> Author: <span>'.$news_user_full_name.'</span></p>';
		$html .= '</div>';
		$html .= '<p>&nbsp;</p>';
		$html .= '<div class="single_work_page_content">';
		$html .= $news_details;
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</section>';
		$html .= '</body>';
		$html .= '</html>';
		
		
		// Get output html
		//$html = $this->output->get_output();
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream($pdf_news_title.".pdf");
	}
	
	/*************** RSS NEWS Feeds **************/
	public function rss_news_feed(){
		// if user is already logged in, redirect to home....
        require_once APPPATH . 'php_include/authenticate.php';
		
		$get_all_news = $this->News_model->get_all_news(0, 10);
		if($get_all_news->num_rows > 0){
			$data_msg['all_news_details'] = $get_all_news->result_array();
		}
		
		$data_msg['total_news'] = $get_all_news->num_rows;
		
		$data_msg['feed_name'] = SITE_NAME; //'MyWebsite.com';
        $data_msg['encoding'] = 'utf-8';
        $data_msg['feed_url'] = base_url().'rss-feed';
        $data_msg['page_description'] = 'Lastest Top 10 News Here';
        $data_msg['page_language'] = 'en-en';
        $data_msg['creator_email'] = SUPPORT_EMAIL;    
        header("Content-Type: application/rss+xml");
         
        $this->load->view('news/rss-feed', $data_msg);	
		
	}
	
	/*************** User's All News Listed **************/
	public function my_news(){
		
        require_once APPPATH . 'php_include/authenticate.php';
		
		// if user is already logged in, redirect to home....
		if (isset($login_nwp_user_id) && $login_nwp_user_id == '0') {
            redirect(base_url());
            exit;
        }
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: My News';
		$data_msg['meta_description'] = 'My News';
		$data_msg['keywords'] = 'My News';
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'my-news';
		
		$get_user_news = $this->News_model->get_user_news($login_nwp_user_id);
		if($get_user_news->num_rows > 0){
			$data_msg['user_news_details'] = $get_user_news->result_array();
		}
		
		$data_msg['total_news'] = $get_user_news->num_rows;
		
		$this->load->view('news/my-news', $data_msg);
	}
	
	/*************** User News Added With Image Upload **************/
	function news_image_upload(){
		if($_FILES['news_image']['size'] != 0){
			$upload_dir = NEWS_IMAGE_UPLOAD_PATH;
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}	
			
			$news_image_name = 'news_img_'.substr(md5(rand()),0,7);
			
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['file_name']     = $news_image_name;
			$config['overwrite']     = false;
			$config['max_size']	 = MAX_UPLOAD_IMAGE_SIZE;
			
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('news_image')){
				$this->form_validation->set_message('news_image_upload', $this->upload->display_errors());
				return false;
			}	
			else{
				//$this->upload_data['file'] =  $this->upload->data();
				$image_data = $this->upload->data();
				$image_file_name = $image_data['file_name'];
				$thumbnail_image_file_name = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
				
				$this->load->library('image_lib');
				
				$thumb_img_config['image_library'] = 'gd2';
				$thumb_img_config['source_image'] = $image_data['full_path'];
				$thumb_img_config['new_image']  = $upload_dir.'thumb/';
				$thumb_img_config['create_thumb'] = TRUE;
				$thumb_img_config['maintain_ratio'] = TRUE;
				$thumb_img_config['quality'] = "100%";
				$thumb_img_config['width']     = 50;
				$thumb_img_config['height']   = 50;
				//$this->load->library('image_lib', $thumb_img_config);
				
				$this->image_lib->clear();
				$this->image_lib->initialize($thumb_img_config);
				$this->image_lib->resize();
				//print_r($result_resp);die;
				
				$mid_img_config['image_library'] = 'gd2';
				$mid_img_config['source_image'] = $image_data['full_path'];
				$mid_img_config['new_image']  = $upload_dir.'mid/';
				$mid_img_config['create_thumb'] = TRUE;
				$mid_img_config['maintain_ratio'] = TRUE;
				$mid_img_config['quality'] = "100%";
				$mid_img_config['width']     = 250;
				$mid_img_config['height']   = 180;
				
				$this->image_lib->clear();
				$this->image_lib->initialize($mid_img_config);
				$this->image_lib->resize();			
				
				$news_title = trim(strip_tags($this->input->post('news_title')));
				$news_details = trim($this->input->post('news_details'));
				
				$news_id = $this->all_function->rand_string(8);
				
				$insert_fields = array(
									'NewsID' => $news_id,
									'UserID' => $this->session->userdata('login_'.SITE_CODE.'_user_id'),
									'NewsTitle' => $news_title,
									'NewsDetails' => $news_details,
									'NewsImage' => $image_file_name,
									'NewsImageThumb' => $thumbnail_image_file_name,
									'IPAddress' => getenv('REMOTE_ADDR'),
									'Status' => '1',
									'AddDate' => date("Y-m-d H:i:s")
								);

				$this->News_model->insert_news_details($insert_fields);
				
				
				return true;
			}	
		}else{
			$this->form_validation->set_message('news_image_upload', "No News Image file selected");
			return false;
		}
	}
	
	/*************** User's News Add **************/
	public function add_news(){
		
        require_once APPPATH . 'php_include/authenticate.php';
		
		// if user is already logged in, redirect to home....
		if (isset($login_nwp_user_id) && $login_nwp_user_id == '0') {
            redirect(base_url());
            exit;
        }
		
		//----- start meta content -----//
		$data_msg['meta_title'] = 'News Portal :: Add News';
		$data_msg['meta_description'] = 'Add News';
		$data_msg['keywords'] = 'Add News';
        //----- start meta content -----//
		
		$data_msg['curr_page'] = 'add-news';
		
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
			
			$this->form_validation->set_rules('news_title', 'News Title', 'required');			
			$this->form_validation->set_rules('news_details', 'News Details', 'required');
			$image_data = $this->form_validation->set_rules('news_image', 'News Image', 'callback_news_image_upload');
			
			if($this->form_validation->run() == FALSE){
				$this->load->view('news/add-news', $data_msg);
			}else{
				$this->session->set_userdata('success_msg', 'New News addded successfully');
			}
			redirect(base_url().'add-news');
			exit;
		}	
		
		$this->load->view('news/add-news', $data_msg);
	}
}

?>