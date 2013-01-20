<?php 
	require 'facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, )); 
	$user = $facebook->getUser();
	$user_profile = $facebook->api($user);
	
	include('configuration.php'); 
	
	function protect($string){$string = trim(strip_tags(addslashes($string))); return $string;}
	$name = protect($_GET['file']); 
	$result = mysql_query("UPDATE facebook_images SET reported=1 WHERE meme_path='$name'") or die(mysql_error()); 
	$EmailTo = "buzz@heyfaisal.com"; 
	$Subject = "Reported Image"; 
	$ImageName = Trim(stripslashes($name)); 
	$Body = ""; 
	$Body .= "Image Name: "; 
	$Body .= "http://www.heyfaisal.com/memify/". $ImageName; 
	$Body .= "\n\n";
	$Body .= "Name: ";
	$Body .= $user_profile['first_name'];
	$Body .= " ";
	$Body .= $user_profile['last_name'];
	
	mail($EmailTo, $Subject, $Body); 
	header('Location: ../reported-image.php'); 
?>