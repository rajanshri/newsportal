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
        
            <div class="clearfix main_content floatleft">
            
               <div class="clearfix content">
						
                    <div class="contact_us">
                    
                        <h1>Add News</h1>
                                                
                        <?php
						
						$form_data = array(
									  'name'        => 'frm_add_news',
									  'id'          => 'frm_add_news',
									);
									
						echo form_open_multipart('add-news', $form_data);
						
						?>
						<!-- Message container start -->
                        <div class="success" id="succ_message_container" style="<?php if(isset($success_msg) && $success_msg != ''){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">                    
                            <?php if(isset($success_msg) && $success_msg != ''){ echo $success_msg; } ?> 
                        </div>
                        <div class="error" id="err_message_container" style="<?php if(isset($error_msg) && $error_msg != ''){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
                            <?php if(isset($error_msg) && $error_msg != ''){ echo $error_msg; } ?>
                        </div>
                        <!-- Message container end -->
                        <?php					
						echo validation_errors();			
						
						
						$txt_news_title_data = array(
									  'name'        => 'news_title',
									  'id'          => 'news_title',
									  'type'        => 'text',
									  'class'       => 'wpcf7-text',
									  'placeholder' => 'News Title'
									);
						
						echo '<p>'.form_input($txt_news_title_data).'</p>';
						
						$txt_news_dtl_data = array(
									  'name'        => 'news_details',
									  'id'          => 'news_details',
									  'class'       => 'wpcf7-textarea',
									  'placeholder' => 'News Details'
									);
						
						echo '<p>'.form_textarea($txt_news_dtl_data).'</p>';
						
						$txt_news_upld_data = array(
									  'name'        => 'news_image',
									  'id'          => 'news_image',
									  'class'       => 'wpcf7-textarea'
									);
						
						echo '<p>'.form_label('Upload News Image', 'news_image').' : '.form_upload($txt_news_upld_data).'</p>';
						
						$btn_submit_data = array(
									  'name'        => 'btn_submit',
									  'id'          => 'btn_submit',
									  'value'       => 'Add News',
									  'class'       => 'wpcf7-submit',
									);
						
						echo '<p>'.form_submit($btn_submit_data).'</p>';
						echo form_close();
						?>
                    </div>
                    
                </div>
                
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