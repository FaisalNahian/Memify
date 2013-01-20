<?php include('templates/header.php') ?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
		<a class="brand" href="http://www.heyfaisal.com/memify/">memify</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Create Meme <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="create.php">Your Images</a></li>
                  <li><a href="create-friend.php">Your Friends Images</a></li>
                  <li><a href="upload-image.php">Upload A Photo</a></li>
				  <li><a href="create-from-url.php">Enter A URL</a></li>
                </ul>
              </li>
			  
			  <li><a href="all-memes.php">Browse Memes</a></li>
              <li class="active"><a href="popular-all-time.php">Popular</a></li>
              <li><a href="random.php">Random</a></li>
			  <?php if ($user): ?>
			  <li><a href="my-memes.php">My Memes</a></li>
			  <?php endif ?>
            </ul>
			<form class="navbar-form pull-right">
              <!--<input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">-->
              <button type="submit" class="btn">Sign in with Facebook</button>
            </form>


			</ul>
          </div><!--/.nav-collapse -->
		</div>
      </div>
    </div>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
			<?php include('templates/navigation.php') ?>
				<!-- Main Content -->
				<div class="span9">
						<!--<p>Here are the 50 most popular memes based on your votes</p>-->
						<?php 
							$result = mysql_query('SELECT * FROM facebook_images WHERE meme_path IS NOT NULL ORDER BY popularity DESC LIMIT 50') or die(mysql_error());
							$count = 0; 
							while($row = mysql_fetch_array($result)) { 
								$date = $row['timestamp'];
								list($path, $fileName) = explode('/', $row['meme_path']);
								if (time() - strtotime($date) <= 86400) {
									if( $count%2 == 0) {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' . 
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											//'<img src="http://memes.heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div>" .
											'<img src="img/new-badge.png" alt="newbadge" width="74px" height="74px" />' . 
											"</div></a>";
									} else {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' .
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div>" .
											'<img src="img/new-badge.png" alt="newbadge" width="74px" height="74px" />' . 
											"</div></a>";
									}
								} else {
									if( $count%2 == 0) {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' .
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' .
											//'<img src="http://memes.heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div></div></a>";
									} else {
										echo '<a href="meme.php?file='.$row['meme_path'].'">' .
											'<div class="image-container">' .
											'<div class="entry">' . 
											'<img src="http://heyfaisal.com/memify/thumbnails/'.$fileName.'" class="thumbnail" alt="Meme" width="156px" height="auto" />' . 
											"</div></div></a>";
										}
									}
									$count++; 
								} 
						?>
	
				</div> <!-- end of span9 -->	
		</div> <!-- end of row -->
<?php include('templates/footer.php') ?>