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
           
           <form class="navbar-form pull-right">
              <!--<input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">-->


            <?php if ($user): ?>


            <div class="btn-group">
            <a class="btn" href="#">
              <img id="image" src="https://graph.facebook.com/<?php echo $user; ?>/picture" width="16px" height="16px">
              <div id="name"><?php echo $me['name']; ?></div>
            </a>
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