<?php  echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
    <channel>
     
    <title><?php echo $feed_name; ?></title>
 
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>
 
    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />
    
    <?php
	if($total_news > 0):
		foreach($all_news_details as $news_details):
		?>
        <item>
 
          <title><?php echo xml_convert($news_details['NewsTitle']); ?></title>
          <link><?php echo base_url().'news/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $news_details['NewsTitle']))).'/'.$news_details['NewsID']; ?></link>
          <guid><?php echo base_url().'news/'.strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $news_details['NewsTitle']))).'/'.$news_details['NewsID']; ?></guid>
 
            <description><![CDATA[ <?php echo character_limiter($news_details['NewsDetails'], 200); ?> ]]></description>
            <pubDate><?php echo date('j M Y', strtotime($news_details['AddDate'])); ?></pubDate>
        </item>
        <?php
		endforeach;
	endif;
	?>
      
    </channel>
</rss>