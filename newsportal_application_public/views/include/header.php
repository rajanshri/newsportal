<!--############################################################## Header Part Start ##############################################################-->

<section id="header_area">
    <div class="wrapper header">
        <div class="clearfix header_top">
            <div class="clearfix logo floatleft">
                <a href="<?php echo base_url(); ?>"><h1><span>News</span> Portal</h1></a>
            </div>
            <div class="clearfix search floatright">
            	<div class="clearfix social floatright">
                    <ul>
                        <li><a class="tooltip" title="RSS Feed" href="<?php echo base_url().'rss-feed/'; ?>"><i class="fa fa-rss-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header_bottom">
            <nav>
                <ul id="nav">
                    <li><a href="<?php echo base_url(); ?>" <?php if(isset($curr_page) && $curr_page == 'index'): echo 'class="active"'; endif; ?>>Home</a></li>
                    <?php
					if (isset($login_nwp_user_id) && $login_nwp_user_id != '0') {
					?>
                    <li><a href="<?php echo base_url(); ?>my-news" <?php if(isset($curr_page) && $curr_page == 'my-news'): echo 'class="active"'; endif; ?>>My News</a></li>                    
                    <li><a href="<?php echo base_url(); ?>add-news" <?php if(isset($curr_page) && $curr_page == 'add-news'): echo 'class="active"'; endif; ?>>Add News</a></li>
                    <?php
					}
					?>                                        
                    <?php
                    if (isset($login_nwp_user_id) && $login_nwp_user_id != '0'):
					?>
                    <li><a href="<?php echo base_url(); ?>signout">Sign Out</a></li>
                    <?php
					else:
					?>
                    <li><a href="<?php echo base_url(); ?>signup" <?php if(isset($curr_page) && $curr_page == 'signup'): echo 'class="active"'; endif; ?>>Sign Up</a></li>
                    <?php
					endif;
					?>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!--############################################################## Header Part End ##############################################################-->