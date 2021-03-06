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
                    <div class="content_title"><h2>Latest Top 10 News</h2></div>
                    
                    <?php
					if($total_news > 0):
						foreach($all_news_details as $news_details):							
						?>
                        <div class="clearfix single_content">
                            <div class="clearfix post_date floatleft">
                                
                                <h3><?php echo date('j', strtotime($news_details['AddDate'])); ?></h3>
                                <p><?php echo date('F', strtotime($news_details['AddDate'])); ?></p>
                                
                            </div>
                            <div class="clearfix post_detail">
                                <h2><a href="<?php echo base_url().'news/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $news_details['NewsTitle']))).'/'.$news_details['NewsID']; ?>"><?php echo $news_details['NewsTitle']; ?></a></h2>
                                <div class="clearfix post-meta">
                                    <p><span><i class="fa fa-user"></i> <?php echo $news_details['UserFullName']; ?></span> <span><i class="fa fa-clock-o"></i> <?php echo date('j M Y', strtotime($news_details['AddDate'])); ?></span></p>
                                </div>
                                <div class="clearfix post_excerpt">
                                    <img src="<?php echo NEWS_IMAGE_UPLOAD_URL.'mid/'.$news_details['NewsImageThumb']; ?>" alt="<?php echo $news_details['NewsImageThumb']; ?>"/>
                                    <p><?php echo strlen($news_details['NewsDetails']) > 250 ? character_limiter($news_details['NewsDetails'], 247)."..." : $news_details['NewsDetails']; ?></p>
                                </div>
                                <a href="<?php echo base_url().'news/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $news_details['NewsTitle']))).'/'.$news_details['NewsID']; ?>">Continue Reading</a>
                            </div>
                        </div>
                        <?php
						endforeach;
					else:
					?>
                    <div class="clearfix single_content">
                    	<div class="clearfix post_detail">
                        	<h2>No news</h2>
                        </div>
                    </div>
                    <?php
					endif;
					?>                    						
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