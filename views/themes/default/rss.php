<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php echo '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    >
    <channel>
        <title><?php echo $feed_name; ?></title>
        <link><?php echo $feed_url; ?></link>
        <description><?php echo $page_description; ?></description>
        <dc:language><?php echo $page_language; ?></dc:language>
        <dc:creator><?php echo $creator_email; ?></dc:creator>
         
        <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
        <admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />
        <?php foreach($posts->result() as $post): ?>
        <item>
            <title><?php echo xml_convert($post->post_title); ?></title>
            <link><?php echo site_url('home/readmore/'.$post->post_id) ?></link>
            <guid><?php echo site_url('home/readmore/'.$post->post_id) ?></guid>
            <description><![CDATA[ <?php echo character_limiter(strip_tags($post->post_content), 400); ?> ]]></description>
            <pubDate><?php echo $post->post_date; ?></pubDate>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>