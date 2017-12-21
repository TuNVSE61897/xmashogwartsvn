<?php
$shirt = rand(1, 6); //choose random shirt
//define the width and height of our images
define("WIDTH", 1000);
define("HEIGHT", 1000);
$dest_image = imagecreatetruecolor(WIDTH, HEIGHT);

//make sure the transparency information is saved
imagesavealpha($dest_image, true);

//create a fully transparent background (127 means fully transparent)
$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);

//fill the image with a transparent background
imagefill($dest_image, 0, 0, $trans_background);

//take create image resources out of the 3 pngs we want to merge into destination image
//$bgPath = 'images/background-xmas.jpg';
$skinPath = 'images/skin/3.png';
$facePath = 'images/face/1.png';
$hairPath = 'images/hair/1.png';
$shirtPath = 'images/shirt/' . $shirt . '.png';
$scarfPath = 'images/scarf/2.png';

$color = 'blonde';

switch ($color) {
    case 'red':
        $rgb = array(160, 46, 4);
        break;
    case 'blonde':
        $rgb = array(239, 237, 86);
        break;
    case 'black':
        $rgb = array(40, 40, 40);
        break;
    default:
         $rgb = array(160, 46, 4);
        break;
}

//create image
//$bgImg = imagecreatefromjpeg($bgPath);
$skinImg = imagecreatefrompng($skinPath);
$faceImg = imagecreatefrompng($facePath);
$hairImg = imagecreatefrompng($hairPath);
$shirtImg = imagecreatefrompng($shirtPath);
$scarfImg = imagecreatefrompng($scarfPath);

//change hair color
//$rgb = array(255-$rgb[0],255-$rgb[1],255-$rgb[2]);
//imagefilter($hairImg, IMG_FILTER_NEGATE);
//imagefilter($hairImg, IMG_FILTER_COLORIZE, $rgb[0], $rgb[1], $rgb[2]);
//imagefilter($hairImg, IMG_FILTER_NEGATE);
//imagealphablending($hairImg, false);
//imagesavealpha($hairImg, true);

//copy each png file on top of the destination (result) png
//imagecopy($dest_image, $bgImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $skinImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $faceImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $hairImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $shirtImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $scarfImg, 0, 0, 0, 0, WIDTH, HEIGHT);

$datetime = new DateTime();
$result = $datetime->format('Y-m-d H:i:s');
$result = str_replace(":", "", $result);
$result = str_replace(" ", "_", $result);

$path = "avas/" . $result . ".png";

//send the appropriate headers and output the image in the browser
header('Content-Type: image/png');

imagepng($dest_image, $path);
//imagedestroy($im);
//destroy all the image resources to free up memory
//imagedestroy($bgImg);
imagedestroy($skinImg);
imagedestroy($faceImg);
imagedestroy($hairImg);
imagedestroy($shirtImg);
imagedestroy($scarfImg);
imagedestroy($dest_image);

      $image = new PHPImage();
//     $image->draw($path);
    $image->save($path, false, true);

//echo $path;
?>