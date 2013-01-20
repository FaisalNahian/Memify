<?php 
	require 'library/functions.php'; 
	require 'library/facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, ));
	$user = $facebook->getUser(); 
	if ($user) { $logoutUrl = $facebook->getLogoutUrl(); 
	} else { $loginUrl = $facebook->getLoginUrl(array( 'scope' => 'user_photos,friends_photos' )); } 
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" lang="en">
	<head>
		<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
		<title>Create A Meme</title>
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

		
		<link href='http://fonts.googleapis.com/css?family=Coda+Caption:800|Days+One|Candal|Carter+One|Oswald|Bowlby+One+SC' rel='stylesheet' type='text/css' />
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
		

<!-- header nav -->

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
    <a class="brand" href="index.php"><img src="img/logo.png" alt="memify" /></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Create Meme <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="create.php">Use Your Image</a></li>
                  <li><a href="create-friend.php">Use Friend's Image</a></li>
                  <li><a href="upload-image.php">Upload A Photo</a></li>
                  <li><a href="create-from-url.php">Enter A URL</a></li>
                </ul>
              </li>
        
        <li><a href="all-memes.php">Browse Memes</a></li>
              <!--<li><a href="popular-all-time.php">Popular</a></li>-->
              <li><a href="random.php">Random</a></li>
            </ul>
           

      </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>







	<div class="container">		
		<!-- Row of columns -->
		<div class="row">

			<!-- Main Content -->
			<div class="span12">
			

							<!-- Load Main Canvas -->
							<?php if ($user): ?>
							<canvas id="canvas" width="" height=""><p class="fallback">We are truely sorry but your browser does not support HTML5 canvas, which is what this website uses to create the memes. If you open this back up in Internet Explorer 9, Google Chrome or Mozilla Firefox it works like a charm and you will be able to create your masterpiece!</p></canvas>

			<!-- Left Content -->
			<div class="span4">
							<div id="create-form">
								<img src="img/blank_loader.png" alt="loader" id="my_image" width="220px" height="19px" />
								<label>Meme Name:</label><input type="text" placeholder="Type a name…" name="memename" id="memename" size="40" />
								<label>Font Style:</label>
									<select id="text_style">
										<option value="'Impact'">Impact</option>
										<option value="'Bowlby One SC'">Bowlby One SC</option>
										<option value="'Candal'">Candal</option>
										<option value="'Coda Caption'">Coda Caption</option>
										<option value="'Carter One'">Carter One</option>
										<option value="'Days One'">Days One</option>
										<option value="'Oswald'">Oswald</option>
									</select>
								<legend>Top Text</legend>
								<label>Line One:</label><input type="text" placeholder="Type something…" id="topText1_" size="40" value=""/>
								<label>Line Two:</label><input type="text" placeholder="Type something…" id="topText2_" size="40" value=""/>
								
								<form class="form-inline">
								<label>Color:</label> 
									<select id="tcolor">
										<option value="#FFFFFF">White</option>
										<option value="#000000">Black</option>
										<option value="red">Red</option>
										<option value="#FFA500">Orange</option>
										<option value="#FFFF00">Yellow</option>
										<option value="#ADD8E6">Light Blue</option>
										<option value="blue">Blue</option>
										<option value="green">Green</option>
										<option value="pink">Pink</option>
									</select>
									<label>&nbsp;Size:</label> 
									<select id="top_size">
										<option value="34pt">34</option>
										<option value="32pt">32</option>
										<option value="30pt">30</option>
										<option value="28pt">28</option>
										<option value="26pt">26</option>
										<option value="24pt">24</option>
										<option value="22pt">22</option>
										<option value="20pt">20</option>
										<option value="18pt">18</option>
									</select>
								</form>

								<legend>Bottom Text</legend>
								<label>Line One:</label><input type="text" placeholder="Type something…" id="bottomText1_" size="40" value=""/>
								<label>Line Two:</label><input type="text" placeholder="Type something…" id="bottomText2_" size="40" value=""/>
								
								<form class="form-inline">
								<label>Color:</label> 
									<select id="bcolor">
										<option value="#FFFFFF">White</option>
										<option value="#000000">Black</option>
										<option value="red">Red</option>
										<option value="#FFA500">Orange</option>
										<option value="#FFFF00">Yellow</option>
										<option value="#ADD8E6">Light Blue</option>
										<option value="blue">Blue</option>
										<option value="green">Green</option>
										<option value="pink">Pink</option>
									</select>
									<label>&nbsp;Size:</label> 
									<select id="bottom_size">
										<option value="34pt">34</option>
										<option value="32pt">32</option>
										<option value="30pt">30</option>
										<option value="28pt">28</option>
										<option value="26pt">26</option>
										<option value="24pt">24</option>
										<option value="22pt">22</option>
										<option value="20pt">20</option>
										<option value="18pt">18</option>
									</select>
									</form>

								<p class="atext">Allow others to create a meme<br/>using this image: 
									<input type="radio" name="allow" id="allow" value="1" /> Yes
									<input type="radio" name="allow" id="allow" value="0" checked /> No</p>
								<button onclick="saveViaAJAX();" class="btn" id="sMeme">Save Meme</button>
							</div>
							
						<?php else: ?>
						<style>
							a.s3d{clear:both;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 4px 5px rgba(0,0,0,.3);-moz-box-shadow:0 4px 5px rgba(0,0,0,.3);box-shadow:0 4px 5px rgba(0,0,0,.3);display:inline-block!important;font:700 13px/36px Arial,Helvetica,Clean,sans-serif;height:26px;position:relative;text-decoration:none;text-shadow:0 1px 1px rgba(255,255,255,.35);width:125px;margin:0 0 10px;padding:0 10px 11px;}
							a.facebook{background:linear-gradient(#4669ab,#304886);border-top:1px solid #8ea4cd;color:rgba(21,31,53,1);text-shadow:0 1px 1px rgba(255,255,255,.35);}
							a.facebook:active{background:linear-gradient(#304886,#4669ab);}
							.icons{background:url('data:image/png; base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAaCAYAAABVc6VBAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDhDRUUyNzQ5MDQ1MTFFMDgwQjVCRTIzRkQ4QjU1OEEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDhDRUUyNzU5MDQ1MTFFMDgwQjVCRTIzRkQ4QjU1OEEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OENFRTI3MjkwNDUxMUUwODBCNUJFMjNGRDhCNTU4QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0OENFRTI3MzkwNDUxMUUwODBCNUJFMjNGRDhCNTU4QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PpSqTW8AABQWSURBVHja7FsHdFTV1j63Ts9kMmkkhJBCJyG0IEp5hK4giIIkgHQQQaUICIqNLkV/FETpPGkqKNIEBKU8mg+kGEDKowZIb5PMzK3/3jeTGEICISiwlp619roz95655ZzvfPvbe9+hltZ9kZSjNQWLAgsGCwS7AJYNtqf/qbW/k3/aP61Eo+4CLATQW2AveD6X1S6BfQH2KYDM8bg/sFfk8/gsH4K1BKtSSpfQnAvrr5bnXH61mXt1iQU7Uvgl9bT80J6zNW9DMqgNtnyXkCk/7HGmS9mHo/U+2P/ARiCo9DRHrKyB+PImEqizEBtn1L7zNIv9w8CmY/9lUT37PM6g8q7d14c12PczBt8+YFXASKERqmAoGtarpn/g1Vpwqg4cy336qJ7V6GXpAZvFNMP0ehTXZ0t89wFbC9aWgdGxcyZiYXWEhc8UQ7sMVQP2FnYUUrKrSbn5YaIikyzJSTJFp59K1JUALlylI4G9ilZJcOsXH+QerWDNwI6COZJ2raswK/I60zuiJEf8pS4AliXDgan6sW63q7FHRhx86IwhiE/j1ubvWx82Kx8lsAyEovYQldT15Y0aKzEc69D52467ktKaqbICxMUei14+dq2nvy3r8NnwS3PX9+KuJMf5QP8UwUFyJNcID0AfaKVQFEUolntTlaV3KKKy8G19/NNxAx/knBzHtgVg/aUDyrAaY9UWXK44/K7XG0a7XM7uD3NSn9f5RUqqUh0/V65e7eKjZSyKWs0Qqm4lvRcxMTzRB/vurz653yeGUP/Lx3pMWeROz45OSjw/JqnR4HXQ+7gO3GPckQWH6q9769dri7e1v7H251cqOegQdJsAsARgrlPAWjNKuWaYx3aXeVN6ALXeOBbuaboiuIjidEgWk7HKmq2742aOGry5og8rK4q95L5qYYG7u3VotNOspwQCq8pk1CdXfDEUMJaO149SJBeR4YzAWl08GvXWw5pUndEwIC/PQViOy08YN2rLoxTvCcAIq0INNqID3WSMqLQjZtUEFO4nwcTUbb88d2Ha6hXJednmLNn5P1VRa6E3RHf50snV5OzYRY2yj577Rs53h+LJgLXITXcOUkMdjBrRFVIMwJamic1k6J6elfOVZ6Cngn2Gc1604vUGwhrMwTRFnVNU1aiIApHdToJbT1sC7nBQRR62UqMRyS636I+fVdlFKMUtHdoyp3mNiODzxe4hB0ypiHiH9Uhg+Kw0Td9QFMUoOvFC4II5foYgChMehngHtgLpyyZliC7f0Fo1tiw9cahL8fF9mIzFw4R/GMRbNFBxdq9EANW47Y2GnkgWcomsqqT/qTXb0nYeXaEcOD083ymEC7Q8AcD1vqwqBmCmgQaWnxrIWbx4umCgvVg9cSsSk0WEufD1mQLtwRDOZCU7Pp9yoOuYD/57/XpSIzj1J3AI3dsrqEMQeKzeRFiGeUeSZaOmFTheM9ntIlJ+Lu4aCED9HcA160EeXBEdhGMYAUD1y5818BjLcBw/TBQFY6FblEVkSnkIfP0AzPmXMwVND3JKgq8WiLRptaK0Z2Ni+pXcFemJYAWPHkwqfnDkpTO3dZ6TfZiMsTaxen6D3ucI7Dt+21jAjfSy0HywmdHhNylkQPvJ2xoNPnHDnQ2gUrQl9+/oXs5ac1+ew/tYzgTrrERVKWSzN8FwpX8iKbIX+AHFKyZijU/L6AV4Yl/eTFiZPA3A00J6FRgHWSfQ7n0jNCTkJ6PNzwErCw/FgB0AWwbuzw/OY4bV3vuOwdDpNTYruGnqPQCXX4VHHxCNTAIb9c8EFd6mqiivlthHZFn2gQix71+QUrCi3cZWNP2WAA/mE+ifOHzO9B13v2kmimINhylWfx5W/irY8zXYdbBtZaRiUPsaJno/NcdE8ykcxeD5Pwf7FYB2HawoSmNZva63LzEWqPcq/j8FPt9886335t92MkmVybcN+vNhNasf5zJya9lZA5cu5k0H90m8OQMJ9PW/GNK79WfBL7Xd7LycrGQdOB2viJLNjzeRZMoVT4hrJs6lIrpJ2POvqDqef0ZSiZmz2AhqKMnpwFnux/D65wA029EFlq69TFp/RVGNeh3/Ei4eT9QZDAyWVEbeaiCj94lFRc3QtOU21lIVHRz/vMRPXs25sF64b2BhJEgz3SVZCvpjFgrApUgakyDgFv4ZgGrD2571pIRwUcoArp1eFDsUnq+jWxKDZFgv9Vo0+7cniV0Kq8FN6ayxEJ39rAVtBbcKZ3IT1Q1KQJE7AICOqqra1JMM14IpL0rHAwFtoVS1VZFuhWtlKS7iVERMnq8FcAUDe81ljRLVlOMKXJghNGDTl/V61fREdUhxNTzWNEt0+qSfv0oMEEvbATC42P1s9msBrRusiZgYv9WjxzINVQNo0Gg7HWev9UAWTCcS+viZBayDgSdNBj/b+pOF3+38SMZIk9eDBtEVaCiKsgKoetxNHWN/2eUkLrcwu3Lb+L7AEEfq1QifVtZPbHb/zjn5chePeC92HrOGVZqQIRrIIKIFF5yW8ftXw+4bVEyBcGdY9g1ZkO9gMgSWILhrgyZrCTprT0UB1YH3YfQUPcVKsW9q98yx+Xpf29nsmyntOJbFBRLtBt9rMJtuDp05+cuyk1x2ZLY1sEANJdwCoQx2ojrTiarIvjAeK0GSPImw86WNRM+wY0ACtbo96UkRO20gWYQmDsWNuz4EcO1mzTRfdPJLuw7Pw7xUqTkgGCFAJTHq9Q5KVnk/3sxzel0SgOr/4PCN4kRA20y4EjSAmAgTWcR8oJE4szcZE995XVJqRtWtB38dJoiSV8FE68onCg1mEMl6mCyJcKoYYPeymG6mZoR4Erp3NIPJosvJzy4l31QsD6oWAM7mbb5ZXuFekq1QbwB4GpaWLEXDS+h0egREhYFlohjMRyWg/7YGBR6bte+Hyb6Vg5PHNImbcPn4qc4KLHYRrH6zpuv8goNulJkSoZlusMjCy8ruUih3nBkEQKWV8kAqndJp0Rf1hqYhSks20jriViUiqjLDG/QjWCPDFR3MlQRNwGO0B/6ToBjXGwzpFm/rFVNlv9+tjaqfDBnU8cTJ/rMHOc5c7ZaXmvnEN/X7NsqV3AZPIhPb0dDwsKJpM6mMrQhxAAYEF7jDTJ7jOokSaLMKxvU8x2T6ms1nTDru+qsJCecfxLWoasFiMpsMlyqSZUfT6wyjXW5nmcADL4Os1Q5YKxJY60IFoj0EZQICh3iZrk35ceMYANU+JGJXrkNLZbhAb3A6XU6fieM+J2UhAJrdamyWknmXPDOEt+guVaBaH6u5DQKL1fGVJbfgU+Y44FzDg2bJMs5PU3AFVKGMl6LbN/8CtIBiiQ7TBti7Sc2bxvBKGZ4QHLdp+5qMkAwh/p217DtMCIBqY8mLpF25QSrrC3DG0bcn90Gga+5w/bQx4z9c9X336ynpYZdvprYoNwjAnakA0JeebT1z0qCeu9D9gpWZewoP8f/Fx2rSiiwXr6Q8CQxpLppweOYa4ZV2q4oAwYWVRIYFba+gaA90C65ud3OVCoUAVmm93vAa7HrtPkEVBRrnAwloz0kTYdi7E98NjgjfVxh4OHNyfVUtpFNI7ZiozbWfaHzXhQaL8t4LGnMnACy7zcuGGLGGBXmnn71898oGYQpXqpUtpmRZnxZRi/yfaZJZTPTl7W0yQnTDBZyyWCVfESbDto/fJZcZM+1muDjqKNQXtKfs6AJ3yVDUH9lunr/ND4m54I0hwqsbXmXHykkjfu88dgaK2nIDS8rPIXaz8QyAagli+F79t654A/utx8+hTUd+VwgszGPRFCMc+PbdccW637w/uipKMbwuigJ3LwBi6gH69QfWmgisVe7SFMvzs0RB4PIAWLViG2/oNmLoN8WjWVdeXpQbjtEMI3QZNnj+vSLdQLvl0vWU7HJdO8jfpkmM6H7P3Pj5rc+ASxS+zGf0zLvBZrnKYg0QyzWI+EPTl4dKby88juDQQACMBGIaYTga7B30FvhjFO40x2Zi5BcMzGSuGbLRt32jojpi0pe7BojpOXU04Bv114hQ3O2omviu8kw/EfTShQDg2nLnniQR2Urp26XdrPKAytOueAyfRSlMN6BYl2UGH/vEg5RvcBwVWctTkfIAS5ZlM8dyA2DXvPKyFWzaa8DhOQe4OcwN5hY7HgYPEekGtqocUW1fm4QeR+91zh6t620+eeHmaEGUyx570Nomgy55dK+2u8+t305iBnfNOLF0056Mc1fblvUT0TO8oY2jNtCc3etUoY/MU4T4bMmJyU3NYCKCPTmmDwGB5gDeQmoGVT1fq2ur2bE7Z/RmLQZtwpxXUkKC4lstRbM9WXuF7HAW5Va4Sjb8/RBCCFMikadtl789fEGgj/excpVknA4SVS1s06g+L2wgj0HT2Irl+sqK7FNedvOE7qOBtZjyXENnNAxB9CNwQqpF/NS4fevbEpEglF8TSUFCrk7T2FVa13u00T2bn+zcrPbCu4EKtIEytHurWZ1axiTlgyj/yN5Wbjl56FRWr0sv62f5qkh8I0L29l05/UtaH+pfpCsYp9ytWGIsFkYA0E/FYkG6elCV8/VGvji2yQ/TB0VO6v0xree36UP8fsKOqblZMavr9Ua/nfVd17Fxjvy8yoXn9G5WZx2AAenzLNjrmBDGS8nOPKsiCn06jp629lZGVoN7gsqdT3y9zImL3hv9fln5mYdfENMWyMj7jB6JIAqhDMN0LF9gobYXVEUDTrX69dCli8XYyiwJ4iBkMzMEWGMXffp9iQRqqUlkttmb7nWTe83r0rzOAhY81h1gVvNyBnZtPnPW6J4rmJh+crbi0vJVVdvEHmw1Y/h4g916vjRQedcK/aHPsqlvY7mOrTqy2/LfBs4dqrgEPwvDc05VXAzUPgNAtQXiS31lg5X4RUWurzlryGecj+XY7thhmRlivhZBPtWnywbH6av9DBRLZ+qY+GVRPRfBQH+KEaV2g4G2I2EDOv7yw4COF8d9vNi6dsuP7ykq8cbUgibiaabcLtDHwCWumfnWyMoBfifI49NaQqRX436L1BiEsiw3CnZtvocbRCasBqEF5shcfd4et+12V8xOEiTRjJMeUS8Kz5VeDFQDWY7DdMGddVV3DoBr/DVp/8xZu49eODj/m4NNLySlRTIUEWsEmS9O6N9hb3T1kAMAqjSPhCCpcj6Z6RMnjM/Yva5Gt39d3DPp8/Zppy9FCI58K+PvdbNy60YnWw6P/xG6n9bAa44IumR7qs6S9F2/vok1vjQhry14yrZ6iiXBBm8loFX9BTWmD8BC8dk19foohfoLW/VxPfdkbDqSo4cAmJGpvhJFdTXTnD9XkDFUKnVviZlxZ9jzryRdWr9gcYvGDW5MW7FhRHkYqmjFypJSO8hn0/Ip4z/29/HeX5E801/VbvxXToRN11LLLfH1Xz5z/mSHFXM3Dm7bolNqKV1S7nV+L1+fetlpGRpbmM2mG0HhYanFQBcDLnUUlm9QtIOgX1R4rLPO/iwI/vEzN3/Tv9QxBWIgkpuwjV+5LP2y4GZcw8j9nnQREmMWBjEAKrFk9SUFwPW2rZljSub+PW3mjsRX0r21YBBUlEfzZhWx4rKoeKX/qTXzjyZejnPfyozFN0SRkVCU+zaP/gJANXtTw0FXAHB3pEbA/eVUDw0/raRkPWGU6VoS+AZ/vqBq4hUTsTqoV9zWwkiwapchyZc3frGu01MNzq7asb/xtz8fbnYh6VZsTp4ztNTEpo5PDbFbjvTt0HJb/NNxezwrQXmM2ArfbsDB3FgySkctFWANScD5mz1/6t6El7uc0yTDfb7dYLbZAjLT0gt1mbNwAgBUVkrLnCscphi8ff3PNevSSWOKrjrfBBdF5g2b8cHYmH81P1KqrDi+/Db+Art8jz53YNMTQZcZRbPYZ339ftc7rJs6PnH4vOWmXBKK72NhS//Pb7021O9/HQT9p6XpGhD4fpJQUMNAtvPyvG0K2mtv3c9emwy7HQWsIxPRkU1C2iXk07z+4JXNSxN7tWu2EyNflyB6r9q+L+wPTaGQTk81vBZot+H1MPF3qXgU9HdqBi+LWLiUHdk5kW14W6SZYjJgjLeoilJT9oh20e3Gco+/kWJG5FNk8MDJk973pCTER3XvWpyC70+ZqgfvrzVn6GtnJyydVpgqSHHlWABUU+Aj2ilPQTLVU0tEbRGVk56p5bL0npDHVC14S92Fr6PAPndnsCETxZmHReMc0Bs5FMOeubZ9FTWwc5y1RNdc6FO0vJN2rfs74orEdu548uKvJyVaVlgAks5EMYlYmwNBz9d8MnbdbwcOv4jRvJSVWxdAdd3JUGkjPpo58dmhA7561IuxKEG6PCpe6ndqzQ8Nvp6Uefr1Ba86Eq908ePMPENokinlo4DDfErUbbSv/WuA8kQ8bI5Pi6jl1af2X+IBISknMNTivvnvDqbi7YUJo6+c+c+hZcd3/jS4MLsg0JQQ1/25jwd/PGPx0Gr1W7COvEqoDxQv07VRH814r13vnl8/DgzP/jG7KlkZnSC8dHL1/qhFo9KyDp3ZcmX+993Zy8nNfUWTF+a1MGGK72hhlh3riFpd0cAnm+tU3RE+rse3hir+mJy7Sv5pZMTAsUsFQThsMpqTj506UtHTCJM2fzXj29nzzh3f+XM0723JfmHcyAM1GtZHsX19+Bfz3tixZGU7U6WA1FfnzdquNxkPeoT0o8/E3Pm/Qorgnyk6H12CdWR8IT/o6sLNDfIv3QoWMx12Oc9p42yWZMakz7W3jE70ezr2vEf8oRaSHvP5xlc+itfJUINsfQDxXmpKAUk85TcZC/P4ykYO9FMqIt6LNSzk41uhgkcwF9Yy8BqYxEZhf4PcpfD8sNv/CzAAeEgIEoeNdfUAAAAASUVORK5CYII=') no-repeat;bottom:5px;display:block;height:26px;position:absolute;right:10px;width:25px;}
							.icons.facebook{background-position:-50px 0;}
						</style>
						    <a href="<?php echo $loginUrl; ?>" class="s3d facebook" title="Login with Facebook to create a meme">Sign in with<span class="icons facebook"></span></a><br><br>
						<?php endif ?>


	
			</div> <!-- end of span4 -->	

<!-- Load Aviary Feather code -->
						<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>
						
						<!-- Instantiate Feather -->
						<script type="text/javascript">
						    var featherEditor = new Aviary.Feather({
						        apiKey: '30b97652c',
						        apiVersion: 2,
						        tools: 'all',
						        appendTo: '',
						        onSave: function(imageID, newURL) {
						            var img = document.getElementById(imageID);
						            img.src = newURL;
						        }
						    });
						
						    function launchEditor(id, src) {
						        featherEditor.launch({
						            image: id,
						            url: src
						        });
						        return false;
						    }
						</script>
						
						<div id="injection_site"></div>
						
						<p><input type="image" src="http://advanced.aviary.com/images/feather/edit-photo.png" value="Edit photo" onclick="return launchEditor('image');" /></p>


			</div> <!-- end of span12 -->	
      </div> <!-- end of row -->
      <br>
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
    		<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript">
			var timer;var path=document.URL.split("=")[1];
			if(path==undefined){path=""}if(path!=""){var fileName=path;$("#image").attr("src","photos/"+fileName)}window.onload=function(){var b=document.getElementById("canvas");
			var c=b.getContext("2d");
			var a=document.getElementById("image");
			a.onload=function(){b.width=a.width;b.height=a.height; $("#form").attr("height",a.height)};
			a.src="photos/"+fileName;
			timer=setInterval("changeScene()",50)};
			function changeScene(){
				var f=document.getElementById("canvas");
				var g=f.getContext("2d");
				var o=$("#text_style").val();
				var m=$("#top_size").val();
				var w=$("#tcolor").val();
				var s=$("#bcolor").val();
				var n=$("#bottom_size").val();
				var d=$("#topText2_").val();
				var e=$("#topText1_").val();
				var a=$("#bottomText2_").val();
				var b=$("#bottomText1_").val();
				width=$("canvas").width();
				height=$("canvas").height();
				var c=document.getElementById("image");
				g.drawImage(c,0,0,width,height);
				g.textAlign="center";
				g.font= m+o;
				g.lineWidth=1;
				g.strokeStyle="#000";
				g.fillStyle=w;
				g.fillText(e,width/2,55);
				g.strokeText(e,width/2,55);
				g.fillText(d,width/2,105);
				g.strokeText(d,width/2,105);
				g.font= n+o;
				g.strokeStyle="#000";
				g.fillStyle=s;
				g.fillText(b,width/2,height-70);
				g.strokeText(b,width/2,height-70);
				g.fillText(a,width/2,height-20);
				g.strokeText(a,width/2,height-20)};
		</script>
		<script type="text/javascript">
			function saveViaAJAX(){
				var c=document.getElementById("canvas");
				var b=c.toDataURL("image/png");
				var e=document.URL.split("=")[1];
				$("#my_image").attr("src","img/loader.gif");
				var aa=$("#memename").val();
				var bb=$("#allow").val();
				
				if(e==undefined){e=""}
				if(e!=""){var f=e}
				var a="canvasData="+b;
				var d=new XMLHttpRequest();
				d.open("POST","library/process.php?file="+f+"&name="+aa+"&allow="+bb,true);
				d.setRequestHeader("Content-Type","canvas/upload");
				d.send(a);
				d.onreadystatechange=function(){
					if(d.readyState==4){
						window.location.href="meme.php?file="+d.responseText
			}}};
			
		</script>
		<img src="" alt="Hidden Image" id="image" class="hidden"/>

  </body>
</html>