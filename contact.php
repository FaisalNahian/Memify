<?php include('templates/header.php') ?>
<?php include('templates/header-nav-no-current.php') ?>
	<div class="container">		
		<!-- Row of columns -->
		<div class="row">
			<?php include('templates/navigation.php') ?>
				<!-- Main Content -->
				<div class="span9">
				
			<p class="aboveContact">If you are having problems with logging into facebook try the following steps:<br/><span class="label label-info">Clear your browser's cache and cookies, refresh and try to login with facebook one more time.</span><br/>If that does not fix your error, or having other issues with the site, please do let us know.<br/><br/></p>
			<form id="contact-form" method="post" action="library/send.php" onsubmit="return validation(this);">


						<label for="name">Name</label> 
						<input type="text" id="Name" name="Name" class="name" size="40" /> 
						<label for="email">Email</label> 
						<input type="text" id="Email" name="Email" class="email" size="40" /> 
						<label for="subject">Subject</label>
						<select name="Subject">
							<option value="General Inquiry">General Inquiry</option>
							<option value="Site Issue">Site Issue</option>
							<option value="Advertising">Advertising</option>
						</select>
						<label for="message">Message</label> 
						<textarea type="text" id="Inquiry" name="Inquiry" rows="15" cols="60" class="inquiry"></textarea> 
<br>
					<input class="btn" type="submit" value="Submit">
		</form>
		<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script> 
		<script type="text/javascript" src="js/jquery.slidinglabels.min.js"></script> 
		<script type="text/javascript" src="js/labels.js"></script>
		<script LANGUAGE="javascript">
		function validation(form) {
			if(form.Name.value == '') {
				alert('Please enter your name');
				form.Name.focus();
				return false;
			}
			if(form.Email.value == '') {
				alert('Please enter your email address');
				form.Email.focus();
				return false;
			}
			if(form.Inquiry.value == '') {
				alert('Please enter a message');
				form.Inquiry.focus();
				return false;
			}
		return true;
		} 
		</script>
				
				</div> <!-- end of span9 -->	
		</div> <!-- end of row -->
<?php include('templates/footer.php') ?>