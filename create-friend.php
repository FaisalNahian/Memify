<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, ));
	$user = $facebook->getUser(); 
	
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); } else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 

	date_default_timezone_set('America/New_York');
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

			<!-- Main Content -->
			<div class="span12">
					
					<style>
					input{  font-size:16px;   color:#555860}
					.search{  position:relative;   margin:0 auto;   width:400px;   margin-bottom:20px}
					.search input{height:36px; width:100%; padding:0 12px 0 25px; background:#fff url('img/search.png') 8px 10px no-repeat; border-width:1px; border-style:solid; border-color:#a8acbc #babdcc #c0c3d2; border-radius:5px; -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; -webkit-box-shadow:inset 0 1px #e5e7ed,0 1px 0 #fcfcfc; -moz-box-shadow:inset 0 1px #e5e7ed,0 1px 0 #fcfcfc; -ms-box-shadow:inset 0 1px #e5e7ed,0 1px 0 #fcfcfc; -o-box-shadow:inset 0 1px #e5e7ed,0 1px 0 #fcfcfc; box-shadow:inset 0 1px #e5e7ed,0 1px 0 #fcfcfc}
					.search input:focus{ outline:none;  border-color:#66b1ee;  -webkit-box-shadow:0 0 2px rgba(85,168,236,0.9);  -moz-box-shadow:0 0 2px rgba(85,168,236,0.9);  -ms-box-shadow:0 0 2px rgba(85,168,236,0.9);  -o-box-shadow:0 0 2px rgba(85,168,236,0.9);  box-shadow:0 0 2px rgba(85,168,236,0.9)}
					.search input:focus+.results{ display:block}
					:-moz-placeholder{ color:#a7aabc;  font-weight:200}
					::-webkit-input-placeholder{ color:#a7aabc;  font-weight:200}
					.lt-ie9 .search input{ line-height:26px}
					</style>
					
				
				<p class="meme-title">Search a friend's name or select a friend from the list below.</p>
				<form class="search pull-left" method="post"><input type="text" name="searchInput" value="" id="searchInput" placeholder="Search a friend.." /></form>
		
			</div> <!-- end of span12 -->


		<div class="span12">
		<table>
			<tbody id="resultTable">
			<tr>
			<?php
				if ($user) { try { 
					$friends = $facebook->api('/me/friends');
					$count = 0;
					foreach ($friends as $key=>$value) {
						foreach ($value as $fkey=>$fvalue) {
							if($count%8 == 0 && $count != 0) 
								echo '</tr><tr>';
							echo '<td>' .
								'<a href="friend-albums.php?id='. $fvalue['id'] .'&name='.$fvalue['name'].'" />' .
								' <img src="https://graph.facebook.com/'.$fvalue['id'].'/picture?type=large" />' .
								'<span>' . 
								stringTruncate($fvalue['name'], 20) . 
								'</span>' .
								'</a></td>';
								$count++;
							}
						}
						} catch (FacebookApiException $e) { error_log($e); $user = null; }
					}
			?>
			</tr>
			</tbody>
		</table>

		

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		$(document).ready(function() {
		 //Declare the custom selector 'containsIgnoreCase'.
		      $.expr[':'].containsIgnoreCase = function(n,i,m){
		          return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase())>=0;
		      };

		      $("#searchInput").keyup(function(){

		          $("#resultTable").find("td").hide();
		          var data = this.value.split(" ");
		          var jo = $("#resultTable").find("td");
		          $.each(data, function(i, v){
		               //Use the new containsIgnoreCase function instead
		               jo = jo.filter("*:containsIgnoreCase('"+v+"')");
		          });
		          jo.show();

		      }).focus(function(){
		          this.value="";
		          $(this).css({"color":"black"});
		          $(this).unbind('focus');
		      }).css({"color":"#C0C0C0"});
		  });
		</script>

			</div> <!-- end of span12 -->	
      </div> <!-- end of row -->
<?php include('templates/footer.php') ?>