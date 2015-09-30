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
                    
                        <h1>Log In</h1>
                                                
                        <?php
						
						$form_data = array(
									  'name'        => 'frm_login',
									  'id'          => 'frm_login'
									);
									
						echo form_open('login', $form_data);
						
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
						
						
						$txt_user_email_data = array(
									  'name'        => 'user_email',
									  'id'          => 'user_email',
									  'type'        => 'text',
									  'class'       => 'wpcf7-text',
									  'placeholder' => 'Email'
									);
						
						echo '<p>'.form_input($txt_user_email_data).'</p>';
						
						$txt_user_pwd_data = array(
									  'name'        => 'user_password',
									  'id'          => 'user_password',
									  'type'        => 'password',
									  'class'       => 'wpcf7-text',
									  'placeholder' => 'Password'
									);
						
						echo '<p>'.form_input($txt_user_pwd_data).'</p>';
						
						$btn_submit_data = array(
									  'name'        => 'btn_submit',
									  'id'          => 'btn_submit',
									  'value'       => 'LogIn',
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