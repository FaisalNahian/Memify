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
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Memify</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<link rev="made" href="mailto: buzz@heyfaisal.com" />
		<meta name="keywords" content="memify, memify friends, meme, memes, meme generator, meme friends, facebook memes, memes from facebook images, facebook friends meme, facebook friendsmeme" />
		<meta name="description" content="Create memes from your or your friends pictures on Facebook." />
		<meta name="author" content="Faisal Nahian" />
		<meta property="fb:app_id" content="176360705809378" />
		<META NAME="ROBOTS" CONTENT="ALL" />
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
		<link href="css/reset.css" media="screen" type="text/css" rel="stylesheet" />
		<link href="css/style.css" media="screen" type="text/css" rel="stylesheet" />
		<!--[if IE]><link rel="stylesheet" type="text/css" href="css/all-ie-only.css" /><![endif]-->
		
		<script type="text/javascript">var switchTo5x=false;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "27ff18f9-5bf6-44aa-84a4-7ed30e791280"}); </script>
		
		<!-- Place this render call where appropriate 
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>-->
		<!--<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>-->
		
	</head>
	<body>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div id="container">


<?php include('templates/header-nav.php') ?>
<section id="middle"> 
	<?php include('templates/navigation.php') ?>
	<article id="main">
			

							<a href="category.php?name=<?php echo $memeName ?>"><p class="meme-title"><?php echo $memeName ?></p></a>
							<?php $name = $_GET['file']; echo '<img src='.$name.' alt="memeFullsize" />'; ?> 

							<div id="meme-buttons">						
								<ul>
								<li><a href="<?php echo $name ?>" class="button primary">TEST IMAGE LINK</a></li>

								<li>
								<a href="meme.php?file=<?php echo $previous_meme ?>" class="button primary" id="previous-button">Previous</a>&nbsp;&nbsp;
								<a href="random.php" class="button primary" id="random-button">Random</a>&nbsp;&nbsp;
								<a href="meme.php?file=<?php echo $next_meme ?>" class="button primary" id="next-button">Next</a>
								</li>

									<li class="votes">
										<form id="Formup" action="library/data.php?file=<?php echo $name ?>" method="post">
											<input type="hidden" value="<?php echo $upvote ?>" name="popularity" id="popularity-up" />
											<!--<input type="image" name="submit" class="button danger icon like primary" value="Like"/>-->
											<!--<input type="submit" value="Thumb Up" class="button arrowup icon"/>-->
											<input type="image" name="submit" src="img/thumbs_up.png" class="thumbs" />
										</form>
										<div id="showdata"><?php echo $popularity ?></div>
										<!--<form id="Formdown" action="library/data.php?file=<?php echo $name ?>" method="post">
											<input type="hidden" value="<?php echo $downvote ?>" name="popularity" id="popularity-down" />
											<input type="image" name="submit" src="img/thumbs_down.png" class="thumbs" />
										</form>-->
									</li>
									<br><br>
									<span class='st_facebook_hcount' displayText='Facebook'></span>
									<span class='st_fbsend_hcount' displayText='Facebook Send'></span>
									<span class='st_twitter_hcount' displayText='Tweet'></span>
									<span class='st_plusone_hcount' displayText='Google +1'></span>
									<span class='st_sharethis_hcount' displayText='ShareThis'></span>
									
									<!--<li><div class="fb-like" data-href="<?php echo $new_url ?>" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div></li>						
									<li><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
									<g:plusone size="medium"></g:plusone></li>
									<li><p class="tinyurl">TinyURL: <?php function get_tiny_url($url) { $ch = curl_init(); $timeout = 5; curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); $data = curl_exec($ch); curl_close($ch); return $data; } $new_url = get_tiny_url('http://heyfaisal.com/memify/meme.php?file='.$name); echo $new_url ?></p></li>-->
									<!--<a href="http://pinterest.com/pin/create/button/?url=<?php echo $new_url ?>&media=<?php echo "http://heyfaisal.com/memify/meme.php?file=$name"?>&description=<?php echo $memeName ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>-->
									<!--<li><a href="random.php" class="button primary" id="randomize">Random</a></li>-->
										<?php if ($user): ?>
									<li><a href="library/report.php?file=<?php echo $name ?>" class="button primary">Report Image</a></li>
									<?php
									if ($approved == 1) {
										echo '<li><a href="make-changes-cfo.php?file='.$nImage.'" class="button primary" id="cNew-button">Caption This?</a></li>';
									} else {}
									?>
									
									
									
									<!--<li><a href="#" class="button primary" alt="Publish to Facebook" onClick="publishStream(); return false;">PUBLISH THIS ON YOUR WALL</a></li>-->
									
																	
									

									<li><a href="<?php echo $publish ?>" class="button primary" alt="Publish this on your Album">PUBLISH THIS ON YOUR WALL</a></li>
									
									
									<li><div class="fb-comments" data-href="<?php echo $new_url ?>" data-num-posts="1" data-width="300"></div></li>
									
									
						<?php else: ?>
						<style>
							a.s3d{clear:both;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 4px 5px rgba(0,0,0,.3);-moz-box-shadow:0 4px 5px rgba(0,0,0,.3);box-shadow:0 4px 5px rgba(0,0,0,.3);display:inline-block !important;font:700 13px/36px 'Arial',Helvetica,Clean,sans-serif;height:26px;margin:0 0 10px;padding:0 10px 11px;position:relative;text-decoration:none;text-shadow:0 1px 1px rgba(255,255,255,.35);width:125px}
							a.facebook{background:#4669ab;background:-webkit-gradient(linear,0 0,0 0,from(#4669ab),to(#304886));background:-moz-linear-gradient(#4669ab,#304886);background:linear-gradient(#4669ab,#304886);border-top:1px solid #8ea4cd;color:rgba(21,31,53,1);text-shadow:0 1px 1px rgba(255,255,255,.35)}
							a.facebook:active{background:#304886;background:-webkit-gradient(linear,0 0,0 0,from(#304886),to(#4669ab));background:-moz-linear-gradient(#304886,#4669ab);background:linear-gradient(#304886,#4669ab)}
							.icons{background:url('data:image/png; base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAaCAYAAABVc6VBAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDhDRUUyNzQ5MDQ1MTFFMDgwQjVCRTIzRkQ4QjU1OEEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDhDRUUyNzU5MDQ1MTFFMDgwQjVCRTIzRkQ4QjU1OEEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OENFRTI3MjkwNDUxMUUwODBCNUJFMjNGRDhCNTU4QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0OENFRTI3MzkwNDUxMUUwODBCNUJFMjNGRDhCNTU4QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PpSqTW8AABQWSURBVHja7FsHdFTV1j63Ts9kMmkkhJBCJyG0IEp5hK4giIIkgHQQQaUICIqNLkV/FETpPGkqKNIEBKU8mg+kGEDKowZIb5PMzK3/3jeTGEICISiwlp619roz95655ZzvfPvbe9+hltZ9kZSjNQWLAgsGCwS7AJYNtqf/qbW/k3/aP61Eo+4CLATQW2AveD6X1S6BfQH2KYDM8bg/sFfk8/gsH4K1BKtSSpfQnAvrr5bnXH61mXt1iQU7Uvgl9bT80J6zNW9DMqgNtnyXkCk/7HGmS9mHo/U+2P/ARiCo9DRHrKyB+PImEqizEBtn1L7zNIv9w8CmY/9lUT37PM6g8q7d14c12PczBt8+YFXASKERqmAoGtarpn/g1Vpwqg4cy336qJ7V6GXpAZvFNMP0ehTXZ0t89wFbC9aWgdGxcyZiYXWEhc8UQ7sMVQP2FnYUUrKrSbn5YaIikyzJSTJFp59K1JUALlylI4G9ilZJcOsXH+QerWDNwI6COZJ2raswK/I60zuiJEf8pS4AliXDgan6sW63q7FHRhx86IwhiE/j1ubvWx82Kx8lsAyEovYQldT15Y0aKzEc69D52467ktKaqbICxMUei14+dq2nvy3r8NnwS3PX9+KuJMf5QP8UwUFyJNcID0AfaKVQFEUolntTlaV3KKKy8G19/NNxAx/knBzHtgVg/aUDyrAaY9UWXK44/K7XG0a7XM7uD3NSn9f5RUqqUh0/V65e7eKjZSyKWs0Qqm4lvRcxMTzRB/vurz653yeGUP/Lx3pMWeROz45OSjw/JqnR4HXQ+7gO3GPckQWH6q9769dri7e1v7H251cqOegQdJsAsARgrlPAWjNKuWaYx3aXeVN6ALXeOBbuaboiuIjidEgWk7HKmq2742aOGry5og8rK4q95L5qYYG7u3VotNOspwQCq8pk1CdXfDEUMJaO149SJBeR4YzAWl08GvXWw5pUndEwIC/PQViOy08YN2rLoxTvCcAIq0INNqID3WSMqLQjZtUEFO4nwcTUbb88d2Ha6hXJednmLNn5P1VRa6E3RHf50snV5OzYRY2yj577Rs53h+LJgLXITXcOUkMdjBrRFVIMwJamic1k6J6elfOVZ6Cngn2Gc1604vUGwhrMwTRFnVNU1aiIApHdToJbT1sC7nBQRR62UqMRyS636I+fVdlFKMUtHdoyp3mNiODzxe4hB0ypiHiH9Uhg+Kw0Td9QFMUoOvFC4II5foYgChMehngHtgLpyyZliC7f0Fo1tiw9cahL8fF9mIzFw4R/GMRbNFBxdq9EANW47Y2GnkgWcomsqqT/qTXb0nYeXaEcOD083ymEC7Q8AcD1vqwqBmCmgQaWnxrIWbx4umCgvVg9cSsSk0WEufD1mQLtwRDOZCU7Pp9yoOuYD/57/XpSIzj1J3AI3dsrqEMQeKzeRFiGeUeSZaOmFTheM9ntIlJ+Lu4aCED9HcA160EeXBEdhGMYAUD1y5818BjLcBw/TBQFY6FblEVkSnkIfP0AzPmXMwVND3JKgq8WiLRptaK0Z2Ni+pXcFemJYAWPHkwqfnDkpTO3dZ6TfZiMsTaxen6D3ucI7Dt+21jAjfSy0HywmdHhNylkQPvJ2xoNPnHDnQ2gUrQl9+/oXs5ac1+ew/tYzgTrrERVKWSzN8FwpX8iKbIX+AHFKyZijU/L6AV4Yl/eTFiZPA3A00J6FRgHWSfQ7n0jNCTkJ6PNzwErCw/FgB0AWwbuzw/OY4bV3vuOwdDpNTYruGnqPQCXX4VHHxCNTAIb9c8EFd6mqiivlthHZFn2gQix71+QUrCi3cZWNP2WAA/mE+ifOHzO9B13v2kmimINhylWfx5W/irY8zXYdbBtZaRiUPsaJno/NcdE8ykcxeD5Pwf7FYB2HawoSmNZva63LzEWqPcq/j8FPt9886335t92MkmVybcN+vNhNasf5zJya9lZA5cu5k0H90m8OQMJ9PW/GNK79WfBL7Xd7LycrGQdOB2viJLNjzeRZMoVT4hrJs6lIrpJ2POvqDqef0ZSiZmz2AhqKMnpwFnux/D65wA029EFlq69TFp/RVGNeh3/Ei4eT9QZDAyWVEbeaiCj94lFRc3QtOU21lIVHRz/vMRPXs25sF64b2BhJEgz3SVZCvpjFgrApUgakyDgFv4ZgGrD2571pIRwUcoArp1eFDsUnq+jWxKDZFgv9Vo0+7cniV0Kq8FN6ayxEJ39rAVtBbcKZ3IT1Q1KQJE7AICOqqra1JMM14IpL0rHAwFtoVS1VZFuhWtlKS7iVERMnq8FcAUDe81ljRLVlOMKXJghNGDTl/V61fREdUhxNTzWNEt0+qSfv0oMEEvbATC42P1s9msBrRusiZgYv9WjxzINVQNo0Gg7HWev9UAWTCcS+viZBayDgSdNBj/b+pOF3+38SMZIk9eDBtEVaCiKsgKoetxNHWN/2eUkLrcwu3Lb+L7AEEfq1QifVtZPbHb/zjn5chePeC92HrOGVZqQIRrIIKIFF5yW8ftXw+4bVEyBcGdY9g1ZkO9gMgSWILhrgyZrCTprT0UB1YH3YfQUPcVKsW9q98yx+Xpf29nsmyntOJbFBRLtBt9rMJtuDp05+cuyk1x2ZLY1sEANJdwCoQx2ojrTiarIvjAeK0GSPImw86WNRM+wY0ACtbo96UkRO20gWYQmDsWNuz4EcO1mzTRfdPJLuw7Pw7xUqTkgGCFAJTHq9Q5KVnk/3sxzel0SgOr/4PCN4kRA20y4EjSAmAgTWcR8oJE4szcZE995XVJqRtWtB38dJoiSV8FE68onCg1mEMl6mCyJcKoYYPeymG6mZoR4Erp3NIPJosvJzy4l31QsD6oWAM7mbb5ZXuFekq1QbwB4GpaWLEXDS+h0egREhYFlohjMRyWg/7YGBR6bte+Hyb6Vg5PHNImbcPn4qc4KLHYRrH6zpuv8goNulJkSoZlusMjCy8ruUih3nBkEQKWV8kAqndJp0Rf1hqYhSks20jriViUiqjLDG/QjWCPDFR3MlQRNwGO0B/6ToBjXGwzpFm/rFVNlv9+tjaqfDBnU8cTJ/rMHOc5c7ZaXmvnEN/X7NsqV3AZPIhPb0dDwsKJpM6mMrQhxAAYEF7jDTJ7jOokSaLMKxvU8x2T6ms1nTDru+qsJCecfxLWoasFiMpsMlyqSZUfT6wyjXW5nmcADL4Os1Q5YKxJY60IFoj0EZQICh3iZrk35ceMYANU+JGJXrkNLZbhAb3A6XU6fieM+J2UhAJrdamyWknmXPDOEt+guVaBaH6u5DQKL1fGVJbfgU+Y44FzDg2bJMs5PU3AFVKGMl6LbN/8CtIBiiQ7TBti7Sc2bxvBKGZ4QHLdp+5qMkAwh/p217DtMCIBqY8mLpF25QSrrC3DG0bcn90Gga+5w/bQx4z9c9X336ynpYZdvprYoNwjAnakA0JeebT1z0qCeu9D9gpWZewoP8f/Fx2rSiiwXr6Q8CQxpLppweOYa4ZV2q4oAwYWVRIYFba+gaA90C65ud3OVCoUAVmm93vAa7HrtPkEVBRrnAwloz0kTYdi7E98NjgjfVxh4OHNyfVUtpFNI7ZiozbWfaHzXhQaL8t4LGnMnACy7zcuGGLGGBXmnn71898oGYQpXqpUtpmRZnxZRi/yfaZJZTPTl7W0yQnTDBZyyWCVfESbDto/fJZcZM+1muDjqKNQXtKfs6AJ3yVDUH9lunr/ND4m54I0hwqsbXmXHykkjfu88dgaK2nIDS8rPIXaz8QyAagli+F79t654A/utx8+hTUd+VwgszGPRFCMc+PbdccW637w/uipKMbwuigJ3LwBi6gH69QfWmgisVe7SFMvzs0RB4PIAWLViG2/oNmLoN8WjWVdeXpQbjtEMI3QZNnj+vSLdQLvl0vWU7HJdO8jfpkmM6H7P3Pj5rc+ASxS+zGf0zLvBZrnKYg0QyzWI+EPTl4dKby88juDQQACMBGIaYTga7B30FvhjFO40x2Zi5BcMzGSuGbLRt32jojpi0pe7BojpOXU04Bv114hQ3O2omviu8kw/EfTShQDg2nLnniQR2Urp26XdrPKAytOueAyfRSlMN6BYl2UGH/vEg5RvcBwVWctTkfIAS5ZlM8dyA2DXvPKyFWzaa8DhOQe4OcwN5hY7HgYPEekGtqocUW1fm4QeR+91zh6t620+eeHmaEGUyx570Nomgy55dK+2u8+t305iBnfNOLF0056Mc1fblvUT0TO8oY2jNtCc3etUoY/MU4T4bMmJyU3NYCKCPTmmDwGB5gDeQmoGVT1fq2ur2bE7Z/RmLQZtwpxXUkKC4lstRbM9WXuF7HAW5Va4Sjb8/RBCCFMikadtl789fEGgj/excpVknA4SVS1s06g+L2wgj0HT2Irl+sqK7FNedvOE7qOBtZjyXENnNAxB9CNwQqpF/NS4fevbEpEglF8TSUFCrk7T2FVa13u00T2bn+zcrPbCu4EKtIEytHurWZ1axiTlgyj/yN5Wbjl56FRWr0sv62f5qkh8I0L29l05/UtaH+pfpCsYp9ytWGIsFkYA0E/FYkG6elCV8/VGvji2yQ/TB0VO6v0xree36UP8fsKOqblZMavr9Ua/nfVd17Fxjvy8yoXn9G5WZx2AAenzLNjrmBDGS8nOPKsiCn06jp629lZGVoN7gsqdT3y9zImL3hv9fln5mYdfENMWyMj7jB6JIAqhDMN0LF9gobYXVEUDTrX69dCli8XYyiwJ4iBkMzMEWGMXffp9iQRqqUlkttmb7nWTe83r0rzOAhY81h1gVvNyBnZtPnPW6J4rmJh+crbi0vJVVdvEHmw1Y/h4g916vjRQedcK/aHPsqlvY7mOrTqy2/LfBs4dqrgEPwvDc05VXAzUPgNAtQXiS31lg5X4RUWurzlryGecj+XY7thhmRlivhZBPtWnywbH6av9DBRLZ+qY+GVRPRfBQH+KEaV2g4G2I2EDOv7yw4COF8d9vNi6dsuP7ykq8cbUgibiaabcLtDHwCWumfnWyMoBfifI49NaQqRX436L1BiEsiw3CnZtvocbRCasBqEF5shcfd4et+12V8xOEiTRjJMeUS8Kz5VeDFQDWY7DdMGddVV3DoBr/DVp/8xZu49eODj/m4NNLySlRTIUEWsEmS9O6N9hb3T1kAMAqjSPhCCpcj6Z6RMnjM/Yva5Gt39d3DPp8/Zppy9FCI58K+PvdbNy60YnWw6P/xG6n9bAa44IumR7qs6S9F2/vok1vjQhry14yrZ6iiXBBm8loFX9BTWmD8BC8dk19foohfoLW/VxPfdkbDqSo4cAmJGpvhJFdTXTnD9XkDFUKnVviZlxZ9jzryRdWr9gcYvGDW5MW7FhRHkYqmjFypJSO8hn0/Ip4z/29/HeX5E801/VbvxXToRN11LLLfH1Xz5z/mSHFXM3Dm7bolNqKV1S7nV+L1+fetlpGRpbmM2mG0HhYanFQBcDLnUUlm9QtIOgX1R4rLPO/iwI/vEzN3/Tv9QxBWIgkpuwjV+5LP2y4GZcw8j9nnQREmMWBjEAKrFk9SUFwPW2rZljSub+PW3mjsRX0r21YBBUlEfzZhWx4rKoeKX/qTXzjyZejnPfyozFN0SRkVCU+zaP/gJANXtTw0FXAHB3pEbA/eVUDw0/raRkPWGU6VoS+AZ/vqBq4hUTsTqoV9zWwkiwapchyZc3frGu01MNzq7asb/xtz8fbnYh6VZsTp4ztNTEpo5PDbFbjvTt0HJb/NNxezwrQXmM2ArfbsDB3FgySkctFWANScD5mz1/6t6El7uc0yTDfb7dYLbZAjLT0gt1mbNwAgBUVkrLnCscphi8ff3PNevSSWOKrjrfBBdF5g2b8cHYmH81P1KqrDi+/Db+Art8jz53YNMTQZcZRbPYZ339ftc7rJs6PnH4vOWmXBKK72NhS//Pb7021O9/HQT9p6XpGhD4fpJQUMNAtvPyvG0K2mtv3c9emwy7HQWsIxPRkU1C2iXk07z+4JXNSxN7tWu2EyNflyB6r9q+L+wPTaGQTk81vBZot+H1MPF3qXgU9HdqBi+LWLiUHdk5kW14W6SZYjJgjLeoilJT9oh20e3Gco+/kWJG5FNk8MDJk973pCTER3XvWpyC70+ZqgfvrzVn6GtnJyydVpgqSHHlWABUU+Aj2ilPQTLVU0tEbRGVk56p5bL0npDHVC14S92Fr6PAPndnsCETxZmHReMc0Bs5FMOeubZ9FTWwc5y1RNdc6FO0vJN2rfs74orEdu548uKvJyVaVlgAks5EMYlYmwNBz9d8MnbdbwcOv4jRvJSVWxdAdd3JUGkjPpo58dmhA7561IuxKEG6PCpe6ndqzQ8Nvp6Uefr1Ba86Eq908ePMPENokinlo4DDfErUbbSv/WuA8kQ8bI5Pi6jl1af2X+IBISknMNTivvnvDqbi7YUJo6+c+c+hZcd3/jS4MLsg0JQQ1/25jwd/PGPx0Gr1W7COvEqoDxQv07VRH814r13vnl8/DgzP/jG7KlkZnSC8dHL1/qhFo9KyDp3ZcmX+993Zy8nNfUWTF+a1MGGK72hhlh3riFpd0cAnm+tU3RE+rse3hir+mJy7Sv5pZMTAsUsFQThsMpqTj506UtHTCJM2fzXj29nzzh3f+XM0723JfmHcyAM1GtZHsX19+Bfz3tixZGU7U6WA1FfnzdquNxkPeoT0o8/E3Pm/Qorgnyk6H12CdWR8IT/o6sLNDfIv3QoWMx12Oc9p42yWZMakz7W3jE70ezr2vEf8oRaSHvP5xlc+itfJUINsfQDxXmpKAUk85TcZC/P4ykYO9FMqIt6LNSzk41uhgkcwF9Yy8BqYxEZhf4PcpfD8sNv/CzAAeEgIEoeNdfUAAAAASUVORK5CYII=') no-repeat;bottom:5px;display:block;height:26px;position:absolute;right:10px;width:25px}
							.icons.facebook{background-position:-50px 0}
						</style>
						    <a href="<?php echo $loginUrl; ?>" class="s3d facebook" title="Login to report this image for review.">Sign in with<span class="icons facebook"></span></a><br><br>
						<?php endif ?>

								</ul>
							</div>
												

		</article>
	<!-- make the middle region's background color expand -->
	<div class="clear"></div>
</section>
<?php include('templates/footer.php') ?>