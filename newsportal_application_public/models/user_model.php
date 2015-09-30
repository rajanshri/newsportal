<?php 
	
	if (!defined('BASEPATH')) exit('No direct script access allowed');

    class User_model extends CI_Model
    {
		/*
         * this function is used to check user existence by same email.
         */

        function email_exist($email)
        {

            $this->db->select('count(UserID) as `TotalRecords`')
                    ->from(TABLEPREFIX.USERDETAILS)
                    ->where('UserEmail', $email)
                    ->where('Status', '1');

            $query = $this->db->get()->result_array();
            $val = $query[0]['TotalRecords'];

            return $val;

        }		

        /*
         * insert new user details
         */

        function insert_user_details($data)
        {
            $this->db->insert(TABLEPREFIX.USERDETAILS, $data);

        }
		
		/*
         * update user details
         */

        function update_user_details($user_id, $data)
        {
			$this->db->where('UserID', $user_id);
            $this->db->update(TABLEPREFIX.USERDETAILS, $data);
        }
		
		/*
         * this function is used to authenticate an user during profile activation.
         */

        function get_user_inactive_status($user_id)
        {

            $this->db->select('Status')
                    ->from(TABLEPREFIX.USERDETAILS)
                    ->where('UserID', $user_id);

            $query = $this->db->get();

            return $query;

        }
		
		/*
         * this function is used to activate user profile by status.
         */

        function activate_useraccount($user_id)
        {

            $data = array(
                        'Status' => '1'
            		);

            $this->db->where('UserID', $user_id);
            $this->db->update(TABLEPREFIX.USERDETAILS, $data);

        }
		
		/*
         * get user id by email
         */

        function get_userid_byemail($email)
        {
            $this->db->select('UserID')
                    ->from(TABLEPREFIX.USERDETAILS)
                    ->where('UserEmail', $email)
					->where('Status','1');

            $query = $this->db->get();

            return $query;

        }	
		
		
		/*
         * this function is used to fetch an user's information by email.
         */

        function user_inf_by_email($email)
        {

            $this->db->select('UserID, UserEmail, UserFullName')
                    ->from(TABLEPREFIX.USERDETAILS)
                    ->where('UserEmail', $email)
                    ->where('Status', '1');

            $query = $this->db->get();

            return $query;

        }
		
		/*
         * this function is used to authenticate an user during login.
         */

        function check_user_login($email, $password)
        {

            $this->db->select('UserID, UserEmail, UserFullName')
                    ->from(TABLEPREFIX.USERDETAILS)
                    ->where('UserEmail', $email)
                    ->where('UserPassword', $password)
                    ->where('Status', '1');

            $query = $this->db->get();
			//echo $this->db->last_query();exit;
            return $query;

        }
		
		/*
         * this function is used to insert each login record during login.
         */

        function insert_user_login($data)
        {
			$this->db->set('LogInTime', 'NOW()', FALSE);
            $this->db->insert(TABLEPREFIX.USERLOGDETAILS, $data);
            //echo $this->db->last_query();exit;

        }
		
		/*
         * this function is used to update each login record during login.
         */

        function update_user_login($user_log_id, $last_login)
        {
			$this->db->set('LogOutTime', 'NOW()', FALSE);
			$this->db->set('LoginDuration', 'TIMEDIFF(NOW(), "'.$last_login.'")', FALSE);
			
            $this->db->where('UserLogID', $user_log_id);
            $this->db->update(TABLEPREFIX.USERLOGDETAILS, $data);

        }		
		
		/*
         * this function is used to fetch last login record of an user.
         */

        function last_user_login($user_id)
        {
            $this->db->select('LogInTime')
                    ->from(TABLEPREFIX.USERLOGDETAILS)
                    ->where('UserID', $user_id)
                    ->limit('1', '0')
                    ->order_by('LogInTime', 'DESC');

            $query = $this->db->get();
            if ($query->num_rows > 0) {
                $val = $query->result_array();
                $val = $val[0]['LogInTime'];
            }
            else {
                $val = 0;
            }
            return $val;

        }
		
		
		
		
	}
	
?>