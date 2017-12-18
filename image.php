<!DOCTYPE html>
<html lang="en">
<head>
	<title>Your owl is here...</title>

	<meta property="og:url"                content="https://hogwarts.vn/SendYourOwl" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="SendYourOwl - Hogwarts.vn" />
	<meta property="og:description"        content="Tạo và chia sẻ thư cú của bạn ngay để nhận ngay thư nhập học hoặc phần quà lưu niệm nhé bồ tèo!" />

	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php 

	function mergeImages($filename_src, $filename_dest, $filename_result) {
 		// Get dimensions for specified images
 		// _src is foreground, _dest is background
		list($width_src, $height_src) = getimagesize($filename_src);	
		list($width_dest, $height_dest) = getimagesize($filename_dest);
 		// Create new image with desired dimensions (background image)
		$image = imagecreatetruecolor($width_dest, $height_dest);
 		// Load images and then copy to destination image
		$image_x = imagecreatefrompng($filename_src);
		$image_y = imagecreatefrompng($filename_dest);
		imagecopy($image, $image_x, 0, 0, 0, 0, $width_dest, $height_dest);
		imagecopy($image, $image_y, 0, 0, 0, 0, $width_dest, $height_dest);
 		// Save the resulting image to disk (as PNG)
		imagepng($image, $filename_result);
		// Clean up
		imagedestroy($image);
		imagedestroy($image_x);
		imagedestroy($image_y);
	}

	function getOptions($owlOption = 'option1', $bgOption = 'option1') {
		switch ($owlOption) {
			case 'option1':
			$owl = 'a';
			break;
			case 'option2':
			$owl = 'b';
			break;
			case 'option3':
			$owl = 'c';
			break;
			case 'option4':
			$owl = 'd';
			break;
			default:
			$owl = 'a';
			break;
		}
		switch ($bgOption) {
			case 'option1':
			$bg = '1';
			break;
			case 'option2':
			$bg = '2';
			break;
			case 'option3':
			$bg = '3';
			break;
			case 'option4':
			$bg = '4';
			break;				
			case 'option5':
			$bg = '5';
			break;
			case 'option6':
			$bg = '6';
			break;
			case 'option7':
			$bg = '7';
			break;		
			default:
			$bg = '1';
			break;
		}
		return array ($owl, $bg);
	}

	function getTextColor($owlOption = 'a') {
		switch ($owlOption) {
			case 'option1':
			$textColor = array(57,31,0);
			break;
			case 'option2':
			$textColor = array(66,38,5);
			break;
			case 'option3':
			$textColor = array(29,6,4);
			break;
			case 'option4':
			$textColor = array(92,41,0);
			break;
			
			default:
			$textColor = array(57,31,0);
			break;
		}
		return $textColor;
	}

	date_default_timezone_set("Asia/Ho_Chi_Minh");
	function generateRandomString($length = 10) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}
	
	?>

	<?php
	
	include 'PHPImage.php';

	$textLetter = $_POST["yourowl"];

	$datetime = new DateTime();
	$result = $datetime->format('Y-m-d H:i:s');
	$result = str_replace(":", "", $result);
	$result = str_replace(" ", "_", $result);
	$path = "owls/" . generateRandomString(4) . "_" . $result . ".jpg";
    //    echo $path;

	list($foreGround, $backGround) = getOptions($_POST["optionsOwls"], $_POST["optionsBackgrounds"]);
	
	$letterImage = "images/" . $foreGround . $backGround . ".jpg";

	$image = new PHPImage();
	$image->setDimensionsFromImage($letterImage);
	$image->draw($letterImage);

	$fontPath = './HONEY-CREAM.ttf';
	$image->setFont($fontPath);

	$textColor = getTextColor($_POST["optionsOwls"]);

	$image->setTextColor($textColor);
	$image->textBox($textLetter, array(
		'fontSize' => 72, // Desired starting font size
		'width' => 630,
		'height' => 470,
		'x' => 200,
		'y' => 420
		));
	$image->save($path, false, true);
	?>

	<div class="fill">	
		<a href="<?php echo $path?>" download>
			<img class="image" src="<?php echo $path?>" alt="#sendyourowl">
		</a>
	</div>
</body>
</html>
