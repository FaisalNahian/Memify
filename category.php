<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, )); 
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 
	
	include('library/configuration.php'); 
	function protect($string){$string = trim(strip_tags(addslashes($string))); return $string;}
	$category = protect($_GET['name']);
	
	include('library/paginator.class.php'); 
	$result = mysql_query("SELECT * FROM `facebook_images` WHERE `meme_name` ='$category' AND `meme_path` IS NOT NULL ORDER BY popularity DESC"); 
	$num_rows = mysql_num_rows($result);
	$pages = new Paginator;
	$pages->items_total = $num_rows;
	$pages->mid_range = 9;
	$pages->paginate();
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify | Choose An Album</title>
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

							<p>Here are the memes named <?php echo $category ?></p>
						<?php 
							$result = mysql_query("SELECT * FROM `facebook_images` WHERE `meme_name` ='$category' ORDER BY popularity DESC $pages->limit") or die(mysql_error());
							$count = 0; 
							while($row = mysql_fetch_array($result)) { 
								$date = $row['timestamp'];
								$MEMEpath = $row['meme_path'];
								list($extension, $fullmemepath) = explode("/", $MEMEpath);
								if (time() - strtotime($date) <= 86400) {
									if( $count%2 == 0) {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' . 
											'<img src="http://memes.heyfaisal.com/memify/thumbnails/'.$fullmemepath.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div>" .
											'<img src="img/new-badge.png" alt="newbadge" width="74px" height="74px" />' . 
											"</div></a>";
									} else {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' .
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fullmemepath.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div>" .
											'<img src="img/new-badge.png" alt="newbadge" width="74px" height="74px" />' . 
											"</div></a>";
									}
								} else {
									if( $count%2 == 0) {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' .
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fullmemepath.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div></div></a>";
									} else {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' . 
											'<img src="http://memes.heyfaisal.com/memify/thumbnails/'.$fullmemepath.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div></div></a>";
										}
									}
									$count++; 
								} 
						?>
					</div> <!-- end of span9 -->
					<div class="span9 offset3">
						<div class="paginator"><?php echo $pages->display_pages(); ?></div>	
					</div> <!-- end of span9 -->
      </div> <!-- end of row -->
<?php include('templates/footer.php') ?>