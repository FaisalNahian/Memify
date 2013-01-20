<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, ));
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 
	
	include('library/configuration.php'); 
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify Memes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<link rev="made" href="mailto: buzz@heyfaisal.com" />
		<meta name="keywords" content="memify, memify friends, meme, memes, meme generator, meme friends, facebook memes, memes from facebook images, facebook friends meme, facebook friendsmeme" />
		<meta name="description" content="Create memes from your or your friends pictures on Facebook." />
		<meta name="author" content="Faisal Nahian" />
		<META NAME="ROBOTS" CONTENT="ALL" />
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="css/reset.css" media="screen" type="text/css" rel="stylesheet" />
		<link href="css/style.css" media="screen" type="text/css" rel="stylesheet" />
		<!--[if IE]><link rel="stylesheet" type="text/css" href="css/all-ie-only.css" /><![endif]-->
	</head>
		
		<style>
		p.center { text-align: center; }
		img.center {   display: block;   margin-left: auto;   margin-right: auto; }
		div.center {   margin-left: auto;   margin-right: auto;   width: 8em; }
		</style>

	</head>
	<body id="index">
		<div id="container">
			<table width="100%" height="100%" align="center">
				
				<div style="padding-top:30px;" ><a href="index.php"><img src="img/logo-large.png" width="300" height="80" alt="memify" class="center" /></a>
				
							<p class="center">Friends are funnier than pictures of cats and dogs!</p>	
							<p class="center">Create memes from your or your friends pictures on Facebook or use your own and share.</p>
							<br/>
							<p class="center">Choose an option below to get started!</p>
					</div>

			<div>

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
                                <h2 class="landing-main">Upload A Photo</h2>
                                <h3 class="landing-sub">from your computer</h3>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="all-memes.php">
                            <div class="landing-content">
                                <h2 class="landing-main">Browse Memes</h2>
                                <h3 class="landing-sub">created by the memify community</h3>
                            </div>
                        </a>
                    </li>
                </ul>
</div>
</table>					
						   <br><br><p class="center">Let's keep the humor clean, and hilarious!!! ;-)</p><br><br>
			<?php include('templates/footer.php') ?>
		</div>
	</body>
</html>