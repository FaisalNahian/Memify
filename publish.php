		<!-- facebook photo upload -->
		<?php
		require 'library/facebook.php';
			require 'library/functions.php';  
		$facebook = new Facebook(array( 'appId' => '176360705809378', 'secret' => '4aebcf109439f0b8b90d3ab655583c05', 'cookie' => true, )); 
	
		include('library/configuration.php');
		



	

		
		$user = $facebook->getUser();
		
		print_r($user);

		$name = 'memes/1346554395.png'; 

		if ($user) {

		//Album info.
		$album_details = array(
		'message'=> 'Add captions to your photos, or create ridiculous memes out of your friends photos.',
		'name'=> 'iMemify Photos'
		);

		//Get album ID of the album you’ve just created – there could well be a cleaner way of doing this.
		$albums = $facebook->api('/me/albums');
		
		$album_uid = null;

		foreach ($albums['data'] as $album) {
		//Test if the current album name is the one that has just been created
		if($album['name'] == $album_details['name'])
		{
			echo " a\n";
		$album_uid = $album[id];
		}
		}

echo " b\n";
		print_r($album_uid);

		if ($album_uid ==null) {

		$create_album = $facebook->api('/me/albums', 'post', $album_details);
echo " c\n";
		var_dump($create_album);

		$album_uid = $create_album [id];
		}
echo " d\n";
		var_dump($album_uid);

		//Upload a photo to album of ID...
		$photo_details = array(
		'message'=> 'Memify [http://apps.facebook.com/iMemify/]'
		);
echo " e\n";
		$file="$name"; //Example image file
		$photo_details['image'] = '@' . realpath($file);
		
		var_dump($photo_details);
		
		$upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);

echo " f\n";
		var_dump($file);
		var_dump($photo_details);
		var_dump ($upload_photo);

		//if ($upload_photo) print_r("This meme was automatically added to your timeline. Check your facebook wall now!");
		
		// header('Location: published-album.php'); 
        if(isset($upload_photo))
        {
            echo "This meme was automatically added to your timeline. <a href='http://facebook.com/{$upload_photo['id']}' target='_blank'>Click here to view or Tag!</a>";
        }

		}

		?>