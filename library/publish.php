<?php 
	require 'facebook.php'; 
	$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, )); 
	$user = $facebook->getUser();
	$user_profile = $facebook->api($user);
	
	include('configuration.php'); 
	

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
'message'=> 'Memify [http://apps.facebook.com/memify-u/]'
);

$file="$name"; //Example image file
$photo_details['image'] = '@' . realpath($file);

$upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);

//print_r($file);

//print_r($photo_details);

//print_r($upload_photo);

//if ($upload_photo) print_r("Success!");

	
	
	
	header('Location: ../reported-image.php'); 
?>