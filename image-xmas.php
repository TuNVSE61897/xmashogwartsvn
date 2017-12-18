

<?php

function getOptions($shirtOption = 'option1', $hairOption = 'option1') {
    switch ($shirtOption) {
        case 'option1':
            $shirt = '1';
            break;
        case 'option2':
            $shirt = '2';
            break;
        case 'option3':
            $shirt = '3';
            break;
        default:
            $shirt = '1';
            break;
    }
    switch ($hairOption) {
        case 'option1':
            $hair = '1';
            break;
        case 'option2':
            $hair = '2';
            break;
        case 'option3':
            $hair = '3';
            break;
        case 'option4':
            $hair = '4';
            break;
        case 'option5':
            $hair = '5';
            break;
        default:
            $hair = '1';
            break;
    }
    return array($shirt, $hair);
}
?>

<?php

$folderName = 'avas';

if (file_exists($folderName)) {
    foreach (new DirectoryIterator($folderName) as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }
        if ($fileInfo->isFile() && time() - $fileInfo->getCTime() >= 60 * 30) {
            unlink($fileInfo->getRealPath());
        }
    }
}

//    include 'PHPImage.php';


list($shirt, $hair) = getOptions($_GET["optionsShirts"], $_GET["optionsHairs"]);


//define the width and height of our images
define("WIDTH", 500);
define("HEIGHT", 500);
$dest_image = imagecreatetruecolor(WIDTH, HEIGHT);
//make sure the transparency information is saved
imagesavealpha($dest_image, true);
//create a fully transparent background (127 means fully transparent)
$trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
//fill the image with a transparent background
imagefill($dest_image, 0, 0, $trans_background);
//take create image resources out of the 3 pngs we want to merge into destination image
$shirtPath = 'images/shirt/' . $shirt . '.png';
$hairPath = 'images/hair/' . $hair . '.png';

$a = imagecreatefrompng('images/0.png');
$b = imagecreatefrompng($shirtPath);
$c = imagecreatefrompng($hairPath);

//change hair color
//$rgb = array(255-$rgb[0],255-$rgb[1],255-$rgb[2]);
imagefilter($c, IMG_FILTER_NEGATE); 
imagefilter($c, IMG_FILTER_COLORIZE, 255, 0, 55); 
imagefilter($c, IMG_FILTER_NEGATE); 
imagealphablending( $c, false );
imagesavealpha( $c, true );

//copy each png file on top of the destination (result) png
imagecopy($dest_image, $a, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $b, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $c, 0, 0, 0, 0, WIDTH, HEIGHT);

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
imagedestroy($a);
imagedestroy($b);
imagedestroy($c);
imagedestroy($dest_image);

//      $image = new PHPImage();
//     $image->draw($path);
//    $image->save($path, false, true);

echo $path;
?>
