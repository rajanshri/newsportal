<?php
if ($this->session->userdata('login_'.SITE_CODE.'_user_id') != '') {
    $login_nwp_user_id = $this->session->userdata('login_'.SITE_CODE.'_user_id');
	$login_nwp_user_fullname = $this->session->userdata('login_'.SITE_CODE.'_user_fullname');
    $login_nwp_user_email = $this->session->userdata('login_'.SITE_CODE.'_user_email');
	$current_user_logid = $this->session->userdata('current_user_logid');
	
	$data_msg['login_nwp_user_fullname'] = $login_nwp_user_fullname;
    $data_msg['login_nwp_user_email'] = $login_nwp_user_email;
	$data_msg['current_user_logid'] = $current_user_logid;
    
} else {
    $login_nwp_user_id = '0';
}

$data_msg['login_nwp_user_id'] = $login_nwp_user_id;

$latest_top_news_details = $this->all_function->get_top_news_details(0, 5);
$data_msg['latest_top_news_details'] = $latest_top_news_details;

?>