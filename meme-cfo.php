<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, ));
	include('library/configuration.php'); 
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 
	
	function protect($string){$string = trim(strip_tags(addslashes($string))); return $string;}
	$meme_path = protect($_GET['file']);
	
	$result = mysql_query("SELECT * FROM facebook_images WHERE meme_path ='$meme_path'") or die(mysql_error());
	while($row = mysql_fetch_array($result)) { 
		$image = $row['path'];
		list($ext, $nImage) = explode('/', $image);
		$upvote = $row['popularity']+1;
		$downvote = $row['popularity']-1;
		$id = $row['id'];
		$approved = $row['approved'];
		$popularity = $row['popularity'];
		$memeName = $row['meme_name'];
		$memePath = $row['meme_path'];
	}
	
	if ($approved == 0) {
		$Dchecked = 'checked';
	} else {
		$Achecked = 'checked';
	}
	
	$original_image = protect($_GET['file']);
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify</title>
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

		<link href="css/style.css" media="screen" type="text/css" rel="stylesheet" />
			
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

		<!-- Google+ -->
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		
		<script type="text/javascript" src="http://webstuffshare.com/demo/AskUserAction/jquery-1.4.2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.ask').click(function(e) {
					e.preventDefault();
					thisHref = $(this).attr('href');
					if($(this).next('div.question').length <= 0)
						$(this).after('<div class="question">Are you sure?<br/> <span class="yes">Yes</span><span class="cancel">Cancel</span></div>');
					$('.question').animate({opacity: 1}, 300);
					$('.yes').live('click', function(){
						window.location = thisHref;
					});
					$('.cancel').live('click', function(){
						$(this).parents('div.question').fadeOut(300, function() {
							$(this).remove();
						});
					});	
				});	
			});
		</script>
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
		
			<!-- Left Sidebar -->
			<div class="span3">
				<ul class="nav nav-tabs nav-stacked">
				  	<li><a href="<?php echo $publish; ?>"><i class="icon-share"></i> PUBLISH ON YOUR WALL</a></li>
				  	<li><a href="#images"><i class="icon-chevron-right"></i> PUBLISH ON TUMBLR</a></li>
				  	<li><a href="#code"><i class="icon-gift"></i> SEND AS A POSTCARD</a></li>
			    	<li><a title="Test Your Hunger IQ" href="https://quiz.wfp.org/?icn=banner&ici=bb-HIQ"><img width="250" height="250" alt="Test Your Hunger IQ" src="http://cdn.wfp.org/banners/quiz/250x250.jpg" /></a></li>
				</ul>
			</div> <!-- end of span3 -->
			
			<!-- Main Content -->
			<div class="span9">
			 <div class="row">
				<div class="span4">			
					<div class="btn-group">
						<a class="btn" href="meme.php?file=<?php echo $previous_meme ?>"><i class="icon-chevron-left"></i> Previous</a>
						<a class="btn" href="meme.php?file=<?php echo $next_meme ?>">Next <i class="icon-chevron-right"></i></a>
					</div>
				</div> <!-- end of span4 -->
				<div class="span5">		
				</div> <!-- end of span5 -->
			</div> <!-- end of row -->
		
				<?php $name = $_GET['file']; echo '<img src='.$name.' alt="memeFullsize" />'; ?>
							
			</div> <!-- end of span9 -->
			
		<div class="span9 offset3">
			<a href="category.php?name=<?php echo $memeName ?>"><p class="meme-title"><?php echo $memeName ?></p></a>

									<?php if ($user): ?>
										<form id="Formallow" action="library/allow.php" method="post">
											<table cellspacing="0" cellpadding="0" id="aTable">
												<tr>
													<td>
														<p class="atext">Allow others to create a meme using this image: 
															<input type="radio" name="allow" id="allow" value="1" <?php echo $Achecked ?> /> Yes
															<input type="radio" name="allow" id="dallow" value="0" <?php echo $Dchecked ?> /> No</p>
													</td>
													<td>
														<input type="hidden" name="user" id="user" value="<?php echo $user ?>" />
														<input type="hidden" name="image" id="image" value="<?php echo $original_image ?>" />
														<!--<input type="submit" value="Allow" id="sAllow" class="button primary"/>-->
													</td>
												</tr>
											</table>
										</form>
										<?php else: ?>
										<?php endif ?>
							

		</div> <!-- end of span9 -->	
      </div> <!-- end of row -->
<?php include('templates/footer.php') ?>
