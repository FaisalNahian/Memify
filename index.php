<?php
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, )); 
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 
	
	include('library/configuration.php'); 
	
	date_default_timezone_set('America/New_York');
?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify</title>
   	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta property="og:title" content="Memify"/>
	    <meta property="og:type" content="website"/>
	    <meta property="og:url" content="http://www.facebook.com/iMemify"/>
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
	    <link href="css/style.css" media="screen" type="text/css" rel="stylesheet" />
	    <style type="text/css">
	      body { padding-top: 5px; padding-bottom: 5px; }
		    p.center { text-align: center; }
			img.center {   display: block;   margin-left: auto;   margin-right: auto; }
			div.center {   margin-left: auto;   margin-right: auto;   width: 8em; }
	    </style>

	    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	
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
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=176360705809378";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<!-- Google+ -->
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>

	</head>
	<body>

	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
				<!-- Main Content -->
				<div class="span12">
								<div class="span4 offset7">					
									<!-- Share -->
									<div class="ct-top-sharing">
										<!-- Twitter -->
										<span class="ct-top-sharing-item">
											<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="http://www.facebook.com/iMemify" data-via="iMemify" data-related="faisalnahian:Memify Developer">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
										</span>
										<!-- GPlus -->
										<span class="ct-top-sharing-item">
											<g:plusone size="medium"></g:plusone>
										</span>

										<!-- Facebook -->
										<span class="ct-top-sharing-item">
											<div class="fb-like" data-href="http://www.facebook.com/iMemify" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
										</span>
										<!-- //Facebook -->
									</div>
								</div>
				<div class="span12" style="margin-top:20px;">
								<a href="index.php"><img src="img/logo-large.png" width="300" height="80" alt="memify" class="center" /></a>
									<br><br>
									<p class="center" style="font-family: 'Bad Script', cursive; font-size:25px;">Friends are funnier than pictures of cats and dogs... ;)</p>
									<br>
									<p class="center" style="color: #aaa; font-size:16px;">So, let's have some fun, shall we?</p>
									<br>
									<p class="center" style="/*color: #206BA4;*/ font-family: 'Bad Script', cursive; font-size:25px;"><strong>Add captions to your photos, or create ridiculous memes out of your friend's photos.</strong></p>
									<br/>
									<p class="center" style="font-size:16px; color: #aaa;">Choose an option below to get started!</p>

				</div> <!-- end of span12 -->
				<div class="span12">
					<br>
					<ul class="landing-menu">
                    <li>
                        <a href="create.php">
                            <div class="landing-content">
                                <h2 class="landing-main">Create Meme</h2>
                                <h3 class="landing-sub">using your facebook images</h3>                              
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="create-friend.php">
                            <div class="landing-content">
                                <h3 class="landing-sub">create meme using your</h3>
                                <h2 class="landing-main">Friend's Images</h2>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="upload-image.php">
                            <div class="landing-content">
                                <h2 class="landing-main">Upload An Image</h2>
                                <h3 class="landing-sub">from your computer</h3>
                            </div>
                        </a>
                    </li>

                    <li>
                    	<a href="create-from-url.php">
                            <div class="landing-content">
                                <h2 class="landing-main">Enter A URL</h2>
                                <h3 class="landing-sub">give an online image URL</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="all-memes.php">
                            <div class="landing-content">
                                <h2 class="landing-main">Browse Memes</h2>
                                <h3 class="landing-sub">created by memify community</h3>
                            </div>
                        </a>
                    </li>
                </ul>
                
                </div> <!-- end of span12 -->
				<div class="span12"><br>
					<p class="center" style="font-family: Merriweather', serif; font-size:16px;">P.S. Let's keep the humor clean, and hilarious!!! ;-)</p><br><br>
				</div> <!-- end of span12 -->
				
			</div> <!-- end of span12 -->
		</div> <!-- end of row -->
<?php include('templates/footer.php') ?>