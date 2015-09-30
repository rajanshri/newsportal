<!--############################################################## Right Panel Start ##############################################################-->

<div class="clearfix sidebar_container floatright">
	
    <?php
	if (isset($login_nwp_user_id) && $login_nwp_user_id == '0') :
	?>	 
    <!-- Log In Section Start -->      
    <div class="clearfix newsletter">
    	<h2>Login</h2>
                 
		<?php						
        $form_data = array(
                      'name'        => 'frm_login',
                      'id'          => 'frm_login',
                      //'onSubmit'    => 'return signupValidation();',
                    );
                    
        echo form_open('login', $form_data);
        
        $txt_user_email_data = array(
                      'name'        => 'user_email',
                      'id'          => 'user_email',
                      'type'        => 'text',
					  'value'       => set_value('user_email', ''),
                      'class'       => 'wpcf7-text',
                      'placeholder' => 'Email'
                    );
        
        echo form_input($txt_user_email_data);
        
        $txt_user_pwd_data = array(
                      'name'        => 'user_password',
                      'id'          => 'user_password',
                      'type'        => 'password',
                      'class'       => 'wpcf7-text',
                      'placeholder' => 'Password'
                    );
        
        echo form_input($txt_user_pwd_data);
        
        $btn_submit_data = array(
                      'name'        => 'btn_submit',
                      'id'          => 'btn_submit',
                      'value'       => 'LogIn',
                      'class'       => 'wpcf7-submit',
                    );
        
        echo form_submit($btn_submit_data);
		
		echo '<a href="'.base_url().'signup/">SIGN UP</a>';
		
        echo form_close();
        ?>        
        
    </div>
    <!-- Log In Section End -->
    <?php
	endif;
	?>
    
    <!-- Most Popular News Section Start -->
    <div class="clearfix sidebar">
        <div class="clearfix single_sidebar">
            <div class="popular_post">
                <div class="sidebar_title"><h2>Most Popular News</h2></div>
                <?php
				if($latest_top_news_details != ''):
				?>
                <ul>
                	<?php
					foreach($latest_top_news_details as $latest_news):
					?>
                    <li><a href="<?php echo base_url().'news/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $latest_news['NewsTitle']))).'/'.$latest_news['NewsID']; ?>"><?php echo $latest_news['NewsTitle']; ?></a></li>
                    <?php
					endforeach;
					?>
                </ul>
                <?php
				else:
					echo 'No News';
				endif;
				?>
            </div>
        </div>        
    </div>
    <!-- Most Popular News Section Start -->
    
</div>

<!--############################################################## Right Panel End ##############################################################-->