<?php include('templates/header.php') ?>
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
              <li class="dropdown">
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
              <li class="active"><a href="random.php">Random</a></li>
            </ul>
			     
           <form class="navbar-form pull-right">
              <!--<input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">-->


            <?php if ($user): ?>


            <div class="btn-group">
            <a class="btn" href="#"><img id="image" src="https://graph.facebook.com/<?php echo $user; ?>/picture" width="16px" height="16px">
              <div id="name"><?php echo $me['name']; ?>
              </div></a>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
              <ul class="dropdown-menu">
               <?php if ($user): ?>
              <li><a href="my-memes.php"><i class="icon-pencil"></i> My Memes</a></li>
              <?php endif ?>
              <li class="divider"></li>
              <li><a href="<?php echo $logoutUrl; ?>"><i class="i"></i> Logout</a></li>
              </ul>
            </div>


            <?php else: ?>
              <div>
                <a class="btn" href="<?php echo $loginUrl; ?>" title="Login to Facebook" >Login with Facebook</a>
              </div>
            <?php endif ?>
          </form>


			</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
			<!-- Left Sidebar -->
			<div class="span3">
				<ul class="nav nav-tabs nav-stacked">
				  	<li><a href="<?php echo $publish; ?>"><i class="icon-share"></i> PUBLISH ON YOUR WALL</a></li>
				  	<li><a href="#images"><i class="icon-chevron-right"></i> PUBLISH ON TUMBLR</a></li>
				  	<li><a href="#code"><i class="icon-gift"></i> SEND AS A POSTCARD</a></li>
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
						<a class="btn" href="random.php"><i class="icon-random"></i> Give Me Another</a>
					</div>
				</div> <!-- end of span4 -->
				<div class="span5">	
									<!-- Share -->
									<div class="ct-top-sharing">
										<!-- Twitter -->
										<span class="ct-top-sharing-item">
											<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
										</span>
										
										<!-- Google+ -->
										<script type="text/javascript">
										  (function() {
										    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
										    po.src = 'https://apis.google.com/js/plusone.js';
										    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
										  })();
										</script>
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
			<?php 
				$sql = mysql_query('SELECT * FROM facebook_images WHERE meme_path IS NOT NULL ORDER BY RAND() LIMIT 1');
				while($row = mysql_fetch_array($sql)) {
					$popularity = $row['popularity'];
					$memeName = $row['meme_name'];
					$randUrl = $row['meme_path'];
					$approved = $row['approved'];
					$upvote = $row['popularity']+1;
					$downvote = $row['popularity']-1;
					$image = $row['path'];
					} 
			?>
				<?php echo '<img src="'.$randUrl.'" alt="memeFullsize" />'; ?>
							
			</div> <!-- end of span9 -->
			
		<div class="span9 offset3">	
			<a href="category.php?name=<?php echo $memeName ?>"><p class="meme-title"><?php echo $memeName ?></p></a>	
					<br>
			<!-- Facebook Comments Plugin -->						
			<div class="fb-comments" data-href="http://heyfaisal.com/memify/meme.php?file=<?php echo $name ?>" data-num-posts="1" data-width="620"></div>	
									
									<?php
										$user = $facebook->getUser();
										if ($user) {

											//Create an album
											$album_details = array(
												'message'=> 'Add captions to your photos, or create ridiculous memes out of your friends photos.',
												'name'=> 'Memify Photos'
											);
																					
										$create_album = $facebook->api('/me/albums', 'post', $album_details);

										//Get album ID of the album you’ve just created – there could well be a cleaner way of doing this.
										$albums = $facebook->api('/me/albums');
										foreach ($albums[data] as $album) {
										//Test if the current album name is the one that has just been created
										if($album[name] == 'Album name'){
										$album_uid = $album[id];
										}
										}

											//Upload a photo to album of ID...
											$photo_details = array(
												'message'=> 'Memify [https://apps.facebook.com/memify-u/]'
											);
											
											$file="$name"; //Example image file
											$photo_details['image'] = '@' . realpath($file);

										$upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);
																		
											print_r($file);
											
											print_r($photo_details);
											
											print_r($upload_photo);
											 
											if ($upload_photo) print_r("Success!");
										  
										}

									?>

		</div> <!-- end of span9 -->	
      </div> <!-- end of row -->
<?php include('templates/footer.php') ?>