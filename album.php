<?php 
	if( !isset($_GET['id']) ) die("No direct access allowed!"); 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, ));
	$user = $facebook->getUser(); 
	if ($user) { try { $logoutUrl = $facebook->getLogoutUrl(); 
		$params = array(); 
		if( isset($_GET['offset']) ) $params['offset'] = $_GET['offset']; 
		if( isset($_GET['limit']) ) $params['limit'] = $_GET['limit']; 
		$params['fields'] = 'name,source,images'; 
		$params = http_build_query($params, null, '&'); 
		$album_photos = $facebook->api("/{$_GET['id']}/photos?limit=400&offset=0"); 
		$photos = array(); 
		if(!empty($album_photos['data'])) { 
			foreach($album_photos['data'] as $photo) { 
				$temp = array(); 
				$temp['id'] = $photo['id']; 
				$temp['name'] = (isset($photo['name'])) ? $photo['name']:''; 
				$temp['picture'] = $photo['images'][1]['source']; 
				$temp['source'] = $photo['source']; 
				$photos[] = $temp; 
		}} 
		} catch (FacebookApiException $e) { error_log($e); $user = null; } 
	} else {header("Location: index.php");} 
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify | Choose A Photo</title>
   	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:title" content="Memify"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:url" content="http://www.heyfaisal.com/memify/"/>
	    <meta property="og:image" content="http://www.heyfaisal.com/memify/img/og-image.png"/>
	    <meta property="og:site_name" content="Memify"/>
		<meta property="fb:app_id" content="176360705809378" />
	    <meta property="og:description"
	          content="Add captions to your photos, or create ridiculous memes out of your friend's photos."/>
		<link rev="made" href="mailto: buzz@heyfaisal.com" />
		<meta name="keywords" content="memify, memify friends, meme, memes, meme generator, meme friends, facebook memes, memes from facebook images, facebook friends meme, facebook friendsmeme" />
		<meta name="description" content="Add captions to your photos, or create ridiculous memes out of your friend's photos." />
		<meta name="author" content="Faisal Nahian" />
		<meta name="ROBOTS" content="ALL" />

		<!-- Le styles -->
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <style type="text/css">
	      body { padding-top: 60px; padding-bottom: 40px; }
	    </style>
	    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	    <link href="css/jquery.fancybox-1.3.4.css" media="screen" type="text/css" rel="stylesheet" />
		<!--[if IE]><link rel="stylesheet" type="text/css" href="css/all-ie-only.css" /><![endif]-->
	
	    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	
	    <!-- Le fav and touch icons -->
	    <link rel="shortcut icon" href="img/ico/favicon.ico">
	    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
	    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
	    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
	    <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
	</head>

	<body>
	
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=176360705809378";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
<?php include('templates/header-nav-create-meme.php') ?>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
			<?php include('templates/navigation.php') ?>	

			<!-- Main Content -->
			<div class="span9">


							<table id="album">
								<tr>
							<?php 
								$count = 0; 
								foreach($photos as $photo) { 
									$lastChild = ""; 
									if( $count%5 == 0 && $count != 0 ) 
										echo "</tr><tr>"; 
									$count++; 
									echo "<td>" . 
										"<a href=\"{$photo['source']}\" title=\"{$photo['source']}\" rel=\"pic_gallery\">" . 
										"<div class=\"thumb\" style=\"background-image: url({$photo['picture']})\"></div>" . 
										"</a></td>"; 
								} 
								?>
								</tr>
							</table>
						


								
			
			
		<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script> 
		<script type="text/javascript" src="js/jquery.fancybox-1.3.4.pack.js"></script>
		<script>$(function(){$("a[rel=pic_gallery]").fancybox({titlePosition:"over",titleFormat:function(d,c,a,b){return'<a href="library/download.php?user=<?=$user?>&file='+d+'" class="btn btn-small">Use This Image</a>'}})});</script>

			
			</div> <!-- end of span9 -->	
        </div> <!-- end of row -->
		<script type="text/javascript">var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-29508192-1']);_gaq.push(['_trackPageview']);(function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>
	
		<footer id="footer">
			<!--<div id="bottomAdvertisement">	</div>-->
				<p class="copy">Memify &copy; 2012. All Rights Reserved.
				<a href="privacy.php" id="privacy"> Privacy</a>
				<a href="terms.php" id="terms">/ Legal Schtuff</a>
				<a href="contact.php" id="issues">/ Contact</a>
				
				<!--	<strong>Connect with us: </strong>
		        <a href="http://www.facebook.com/pages/Memify-Community/150173858437134">Facebook</a>
				<a href="https://twitter.com/FaisalNahian">/ Twitter</a>		
		
				<a href="about.php" id="about"> | About</a>
				<a href="https://www.facebook.com/dialog/feed?app_id=176360705809378&redirect_uri=http://apps.facebook.com/memify-u/">/ Share</a> -->
				</p>
		</footer>
	
	</div> <!-- /container -->
				
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>