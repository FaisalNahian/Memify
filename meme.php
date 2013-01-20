<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, 'fileUpload' => true ));
	include('library/configuration.php'); 
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'photo_upload,first_name,email,publish_stream,read_stream,user_photos,friends_photos' )); } 
	
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
	}
	
		
	$origin_id = mysql_query("SELECT `id` FROM `facebook_images` WHERE `meme_path` ='$meme_path'") or die(mysql_error());
	$original_id = mysql_fetch_array($origin_id);
	
	$original_image = $_GET['file'];
	
	//get the max database row from the database
	$results = mysql_query("SELECT MAX(id) FROM `facebook_images` WHERE `meme_path` IS NOT NULL");
	$data = mysql_fetch_array($results);
	
	if ($original_id[0] == 1) {
		$next_meme = $_GET['file'];
	} else {
		//get the next database row for the next button
		$select_2 = mysql_query("SELECT * FROM `facebook_images` WHERE `id` < $id AND `meme_path` IS NOT NULL ORDER BY `id` DESC LIMIT 1");
		while($rowsn = mysql_fetch_array($select_2)) {
			$next_meme = $rowsn['meme_path'];
		}
	}
	
	if ($original_id[0] == $data[0]) {
		$previous_meme = $_GET['file'];
	} else {
		//get the previous database row for the previous button
		$select_1 = mysql_query("SELECT * FROM `facebook_images` WHERE `id` > $id AND `meme_path` IS NOT NULL ORDER BY `id` ASC LIMIT 1");
		while($rows = mysql_fetch_array($select_1)) {
			$previous_meme = $rows['meme_path'];
		}
	}

		//current page url
		function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
		}

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
		<!-- Facebook -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=176360705809378";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

	</head>

	<body>



		
<?php include('templates/header-nav.php') ?>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">

			<!-- Left Sidebar -->
			<div class="span3">
				<ul class="nav nav-tabs nav-stacked">

				  	<li><a href="http://heyfaisal.com/memify/publish.php"><i class="icon-share"></i> PUBLISH ON YOUR WALL</a></li>
				  	<li><a href="http://www.tumblr.com/share/"><i class="icon-chevron-right"></i> PUBLISH ON TUMBLR</a></li>
				  	<li><a href="#postcard"><i class="icon-gift"></i> SEND AS A POSTCARD</a></li>
				<?php
					if ($approved == 1) {
					echo '<li><a href="make-changes-cfo.php?file='.$nImage.'"><i class="icon-edit"></i> CAPTION THIS</a></li>';
					} else {}
				?>
					<li><a href="library/delete.php?file=<?php echo $original_image ?>" ><i class="icon-trash"></i> DELETE MEME</a></li>
					<li><a href="library/report.php?file=<?php echo $name ?>"><i class="icon-flag"></i> REPORT IMAGE</a></li>
				    <li><a title="Test Your Hunger IQ" href="https://quiz.wfp.org/?icn=banner&ici=bb-HIQ"><img width="250" height="250" alt="Test Your Hunger IQ" src="http://cdn.wfp.org/banners/quiz/250x250.jpg" /></a></li>
				</ul>
			</div> <!-- end of span3 -->	
		
			<!-- Main Content -->
			<div class="span9">
			 <div class="row">
				<div class="span4">			
					<div class="btn-group">
						<a class="btn" href="meme.php?file=<?php echo $previous_meme ?>"><i class="icon-chevron-left"></i> Previous</a>
						<a class="btn" href="random.php"><i class="icon-random"></i> Random</a>
						<a class="btn" href="meme.php?file=<?php echo $next_meme ?>">Next <i class="icon-chevron-right"></i></a>
					</div>
				</div> <!-- end of span4 -->
				<div class="span5">	
									<!-- Share -->
									<div class="ct-top-sharing">
										<!-- Twitter -->
										<span class="ct-top-sharing-item">
											<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
										</span>
										<!-- GPlus -->
										<span class="ct-top-sharing-item">
											<g:plusone size="medium"></g:plusone>
										</span>

										<!-- Facebook -->
										<span class="ct-top-sharing-item">
											<div class="fb-like" data-href="<?php echo curPageURL(); ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div>
										</span>
										<!-- //Facebook -->
										
										<!-- AddThis -->
										<span class="ct-top-sharing-item" style="margin-left:25px;">
											<!-- AddThis Button BEGIN -->
											<div class="addthis_toolbox addthis_default_style ">
												<a class="addthis_counter addthis_pill_style"></a>
											</div>
											<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=faisalnahian"></script>
											<!-- AddThis Button END -->
										</span>
									</div>

										<!--<form id="Formup" action="library/data.php?file=<?php echo $name ?>" method="post">
											<input type="hidden" value="<?php echo $upvote ?>" name="popularity" id="popularity-up" />
											<input type="image" name="submit" src="img/thumbs_up.png" class="thumbs" />
										</form>
										<div id="showdata"><?php echo $popularity ?></div>
										<form id="Formdown" action="library/data.php?file=<?php echo $name ?>" method="post">
											<input type="hidden" value="<?php echo $downvote ?>" name="popularity" id="popularity-down" />
											<input type="image" name="submit" src="img/thumbs_down.png" class="thumbs" />
										</form>-->
				</div> <!-- end of span5 -->
			</div> <!-- end of row -->

		<br>
				<?php $name = $_GET['file']; echo '<img src='.$name.' alt="memeFullsize" />'; ?> 
							
			</div> <!-- end of span9 -->


		<div class="span9 offset3">	
			<a href="category.php?name=<?php echo $memeName ?>"><p class="meme-title"><?php echo $memeName ?></p></a>
			<br>

		<!-- Short URL -->
		<p><span class="label label-info">Link: </span><code><?php function get_tiny_url($url) { $ch = curl_init(); $timeout = 5; curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data = curl_exec($ch); curl_close($ch); return $data; } $new_url = get_tiny_url('http://heyfaisal.com/memify/meme.php?file='.$memePATH); echo $new_url ?></code></p>	
	


		<!-- facebook photo upload -->
		<?php
		
		$user = $facebook->getUser();

		if ($user) {

		//Album info.
		$album_details = array(
		'message'=> 'Add captions to your photos, or create ridiculous memes out of your friends photos.',
		'name'=> 'iMemify Photos'
		);

		//Get album ID of the album you’ve just created – there could well be a cleaner way of doing this.
		$albums = $facebook->api('/me/albums');
		
		$album_uid = null;

		foreach ($albums['data'] as $album) {
		//Test if the current album name is the one that has just been created
		if($album['name'] == $album_details['name'])
		{
//echo " a\n";
		$album_uid = $album[id];
		}
		}

//echo " b\n";
		//print_r($album_uid);

		if ($album_uid ==null) {

		$create_album = $facebook->api('/me/albums', 'post', $album_details);
//echo " c\n";
		//var_dump($create_album);

		$album_uid = $create_album [id];
		}
//echo " d\n";
		//var_dump($album_uid);

		//Upload a photo to album of ID...
		$photo_details = array(
		'message'=> 'Memify [http://apps.facebook.com/iMemify/]'
		);
//echo " e\n";
		$file="$name"; //Example image file
		$photo_details['image'] = '@' . realpath($file);
		
		//var_dump($photo_details);
		
		$upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);

//echo " f\n";
		//var_dump($file);
		//var_dump($photo_details);
		//var_dump ($upload_photo);

		//if ($upload_photo) print_r("This meme was automatically added to your timeline. Check your facebook wall now!");
		
		// header('Location: published-album.php'); 
        if(isset($upload_photo))
        {
            echo "This meme was automatically added to your timeline. <a href='http://facebook.com/{$upload_photo['id']}' target='_blank'>Click here to view or Tag!</a>";
        }

		}

		?>

		<br><br>

			<!-- Facebook Comments Plugin -->						
			<div class="fb-comments" data-href="<?php echo curPageURL(); ?>" data-num-posts="1" data-width="600"></div>	
									
								

																

		</div> <!-- end of span9 -->	
      </div> <!-- end of row -->
<?php include('templates/footer.php') ?>