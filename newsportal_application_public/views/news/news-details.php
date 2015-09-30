<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<!-- start meta head -->
<?php $this->load->view('include/meta-head'); ?>
<!-- end meta head -->
</head>

<body>

    <!-- Header Part Start -->
    <?php $this->load->view('include/header'); ?>
    <!-- Header Part End -->   	
    
    <!-- BEGIN CONTENT -->
    <section id="content_area">
        <div class="clearfix wrapper main_content_area">
        
        	 <!-- Message container start -->
            <div class="success" id="succ_message_container" style="<?php if(isset($success_msg) && $success_msg != ''){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">                    
                <?php if(isset($success_msg) && $success_msg != ''){ echo $success_msg; } ?> 
            </div>
            <div class="error" id="err_message_container" style="<?php if(isset($error_msg) && $error_msg != ''){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
                <?php if(isset($error_msg) && $error_msg != ''){ echo $error_msg; } ?>
            </div>
            <?php
			echo validation_errors();
			?>
            <!-- Message container end -->
        
            <div class="clearfix main_content floatleft">
            
                
                
                <div class="clearfix content">
                	<div class="content_title"><h2><?php echo $news_title; ?></h2></div>
                    <div class="single_work_page clearfix">
                        <div class="work_single_page_feature"><img src="<?php echo NEWS_IMAGE_UPLOAD_URL.$news_image; ?>"/></div>
                        <div class="work_meta clearfix">
                            <p class="floatleft">Dated : <span> <?php echo date('j F Y', strtotime($news_add_date)); ?></span> Author: <span><?php echo $news_user_full_name; ?></span></p>
                            <a class="floatright" href="<?php echo base_url().'news-pdf-download/'.$news_id; ?>" target="_blank"><i class="fa fa-cloud-download"></i>Download</a>
                        </div>
                        <div class="single_work_page_content">
                            <?php echo $news_details; ?>
                        </div>
                        
                    </div>
                    						
                </div>                
                <br clear="all" />
            </div>
            
            <!-- Right Panel Start -->
			<?php $this->load->view('include/right-panel'); ?>  
            <!-- Right Panel End -->
        </div>
    </section>
	<!-- END CONTENT -->

    <!-- Footer Part Start -->
    <?php $this->load->view('include/footer'); ?>  
    <!-- Footer Part End -->


</body>
</html>