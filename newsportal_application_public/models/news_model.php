<?php 
	
	if (!defined('BASEPATH')) exit('No direct script access allowed');

    class News_model extends CI_Model
    {

        /*
         * insert new news details
         */

        function insert_news_details($data)
        {
            $this->db->insert(TABLEPREFIX.NEWSDETAILS, $data);

        }
		
		/*
         * update news details
         */

        function update_news_details($news_id, $data)
        {
			$this->db->where('NewsID', $news_id);
            $this->db->update(TABLEPREFIX.NEWSDETAILS, $data);
        }
		
		/*
         * get news by user
         */

        function get_user_news($user_id, $limit_from = null, $total_row_display = null)
        {
           
			$this->db->select('nd.*, ud.UserFullName, ud.UserEmail')
                    ->from(TABLEPREFIX.NEWSDETAILS.' as `nd`')
					->join(TABLEPREFIX.USERDETAILS.' as `ud`','ud.UserID=nd.UserID')
                    ->where('ud.UserID', $user_id)
                    ->where('nd.Status', '1')
                    ->where('ud.Status', '1')
					->order_by('nd.AddDate', 'DESC');
					
					if($total_row_display != null){
						$this->db->limit($total_row_display, $limit_from);  
					}

            $query = $this->db->get();

            return $query;

        }
		
		/*
         * get news 
         */

        function get_all_news($limit_from = null, $total_row_display = null)
        {
           
			$this->db->select('nd.*, ud.UserFullName, ud.UserEmail')
                    ->from(TABLEPREFIX.NEWSDETAILS.' as `nd`')
					->join(TABLEPREFIX.USERDETAILS.' as `ud`','ud.UserID=nd.UserID')                    
                    ->where('nd.Status', '1')
                    ->where('ud.Status', '1')
					->order_by('nd.AddDate', 'DESC');
										
					if($total_row_display != null){
						$this->db->limit($total_row_display, $limit_from);  
					}

            $query = $this->db->get();

            return $query;

        }
		
		/*
         * get news details
         */

        function get_news_details($news_id, $user_id = null)
        {
            
			$this->db->select('nd.*, ud.UserFullName, ud.UserEmail')
                    ->from(TABLEPREFIX.NEWSDETAILS.' as `nd`')
					->join(TABLEPREFIX.USERDETAILS.' as `ud`','ud.UserID=nd.UserID')
                    ->where('nd.NewsID', $news_id)
                    ->where('nd.Status', '1')
                    ->where('ud.Status', '1')
					->order_by('nd.AddDate', 'DESC');
					
					if($user_id != null){
						$this->db->where('ud.UserID', $user_id);  
					}

            $query = $this->db->get();

            return $query;

        }
		
		
	}
	
?>