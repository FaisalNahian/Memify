<?
// Upload image from the filesystem
$ch = curl_init();
$request = array('appkey'=>'UBW6695CUJ08ZX78I5PMYWZX3LYY57Z7MC8PH8FU', 'photo'=>'@/memes/1322630223.png');
curl_setopt($ch, CURLOPT_URL, 'https://snapi.sincerely.com/shiplib/upload');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);

// parse json response to ensure we have a valid upload
if ($output) {
    $response = json_decode($output);
    
    if ($response->id > 0) {
        $frontPhotoId = $response->id;
    } else {
        echo "An error occurred";
    }
}

// set up recipient array with two recipients
$recipients[] = array('name'=>'John Smith','street1'=>'1 Main St','city'=>'San Francisco','state'=>'CA','postalcode'=>'94102','country'=>'United States');
$recipients[] = array('name'=>'Jane Doe','street1'=>'123 Mission St','city'=>'San Francisco','state'=>'CA','postalcode'=>'94105','country'=>'United States');

// set up sender array
$sender = array('name'=>'Pepper Gram','email'=>'pepper@sincerely.com','street1'=>'800 Market Street','city'=>'San Francisco','state'=>'CA','postalcode'=>'94102','country'=>'United States');

$url = 'https://snapi.sincerely.com/shiplib/create';
$request = array(
    'appkey'=>'UBW6695CUJ08ZX78I5PMYWZX3LYY57Z7MC8PH8FU',
    'message'=>'This is a test',
    'frontPhotoId'=>$frontPhotoId,
    'testMode'=>true,
    'recipients'=>json_encode($recipients),
    'sender'=>json_encode($sender)
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// send request
$output = curl_exec($ch);
curl_close($ch);

if ($output) {
    $response = json_decode($output);
    
    if ($response->success == true) {
        /// success!
    } else {
        echo "An error occurred";
    }
}