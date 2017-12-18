<?php
function get_youtube_title($video_id){
			//https://www.googleapis.com/youtube/v3/videos?id=BDAgRHRAeQI&key=AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM&part=snippet
	$html = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key=AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM&part=snippet';
	$response = file_get_contents($html);
	$decoded = json_decode($response, true);
	foreach ($decoded['items'] as $items) {
		$title= $items['snippet']['title'];
		return $title;
	}
}

function get_youtube_id($chanel_name) {
	$html = 'https://www.googleapis.com/youtube/v3/channels?key=AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM&forUsername=' . $chanel_name . '&part=id';
	$response = file_get_contents($html);
	$decoded = json_decode($response, true);
	foreach ($decoded['items'] as $items) {
		$channel_id = $items['id'];
		return $channel_id;
	}	
}

function get_youtube_view($video_id) {
	$html = 'https://www.googleapis.com/youtube/v3/videos?part=statistics&id=' . $video_id . '&key=AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM';
			//$JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=statistics&id=hqepb5hzuB0&key={YOUR-API-KEY}");
	$JSON = file_get_contents($html);
	$json_data = json_decode($JSON, true);
			//return $json_data['items'][0]['statistics']['viewCount'];
	foreach ($json_data['items'] as $items) {
		$view_count = $items['statistics']['viewCount'];
		return $view_count;
	}
}

function get_videos_playlist($playlist) {
	$baseUrl = 'https://www.googleapis.com/youtube/v3/';
    		// https://developers.google.com/youtube/v3/getting-started
	$apiKey = 'AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM';

	$params = [
	'part'=> 'snippet',
	'playlistId' => $playlist,
	'maxResults'=> '50',
	'key'=> $apiKey
	];
	$url = $baseUrl . 'playlistItems?' . http_build_query($params);
	$json = json_decode(file_get_contents($url), true);

	$videos = [];
	foreach($json['items'] as $video)
		$videos[] = $video['snippet']['resourceId']['videoId'];

	while(isset($json['nextPageToken'])){
		$nextUrl = $url . '&pageToken=' . $json['nextPageToken'];
		$json = json_decode(file_get_contents($nextUrl), true);
		foreach($json['items'] as $video)
			$videos[] = $video['snippet']['resourceId']['videoId'];
	}
			//print_r($videos);
	foreach ($videos as $video_id) {
		echo get_youtube_title($video_id) . "\n" . "------" . get_youtube_view($video_id) . "\n";
	}

}


if (isset($_POST['submit'])) {
		// form was submitted
	$playlistid = $_POST["playlistid"];
	$channelid = $_POST["channelid"];

	if ($username == "kevin" && $password == "secret") {
			// successful login
		redirect_to("https://hogwarts.vn");
	} else {
		$message = "There were some errors.";
	}


} else {
	$playlistid = "";
	$channelid = "";
	$message = "Please enter valid value!";
}

// $baseUrl = 'https://www.googleapis.com/youtube/v3/';
//     	// https://developers.google.com/youtube/v3/getting-started
// $apiKey = 'AIzaSyBm-RS6DPknbNh1xtGqs0n4bkBlxyRMDpM';
//     	// If you don't know the channel ID see below
// $channelId = get_youtube_id('popskids');

// $params = [
// 'id'=> $channelId,
// 'part'=> 'contentDetails',
// 'key'=> $apiKey
// ];
// $url = $baseUrl . 'channels?' . http_build_query($params);
// $json = json_decode(file_get_contents($url), true);

// $playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

// $params = [
// 'part'=> 'snippet',
// 'playlistId' => $playlist,
// 'maxResults'=> '50',
// 'key'=> $apiKey
// ];
// $url = $baseUrl . 'playlistItems?' . http_build_query($params);
// $json = json_decode(file_get_contents($url), true);

// $videos = [];
// foreach($json['items'] as $video)
// 	$videos[] = $video['snippet']['resourceId']['videoId'];

// while(isset($json['nextPageToken'])){
// 	$nextUrl = $url . '&pageToken=' . $json['nextPageToken'];
// 	$json = json_decode(file_get_contents($nextUrl), true);
// 	foreach($json['items'] as $video)
// 		$videos[] = $video['snippet']['resourceId']['videoId'];
// }
// 		//print_r($videos);
// foreach ($videos as $video_id) {
// 	echo get_youtube_title($video_id) . "\n" . "------" . get_youtube_view($video_id) . "\n";
// }

?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title>Form</title>
</head>
<body>

	<?php echo $message; ?><br />

	<form action="youtube.php" method="post">
		Enter PlaylistID: <input type="text" name="playlistid" value="<?php echo htmlspecialchars($playlistid); ?>" /><br />
		Enter ChannelID: <input type="text" name="channelid" value="<?php echo htmlspecialchars($channelid); ?>" /><br />
		<br />
		<input type="submit" name="submit" value="Submit" />
	</form>

</body>
</html>
