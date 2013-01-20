<?php include('templates/header.php') ?>
<?php include('templates/header-nav-no-current.php') ?>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
			<?php include('templates/navigation.php') ?>
				<!-- Main Content -->
				<div class="span9">
				
					<div class="box">
						<p>Enter a URL in the box below and click submit to use the image to create a meme.</p>
						<!--<p style="font-weight:bold; color:red;">Make sure you are using the URL for the image and not for the page it is on!</p>--><br/>
						<form method="post" action="library/down-from-url.php?user=<?php echo $user ?>" id="from-url">
							<input type="text" id="iUrl" name="iUrl" size="50" />
							<input class="btn" type="submit" value="Submit">
						</form>
					</div>
			
			
				</div> <!-- end of span9 -->	
		</div> <!-- end of row -->
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
	$('#photoimg').live('change', function() { 
		$("#preview").html('');
		$("#preview").html('<img src="img/loader.gif" alt="Uploading...."/>');
		$("#imageform").ajaxForm({
			target: '#preview'
		}).submit();
	});
</script>
<?php include('templates/footer.php') ?>