

<?php

function getOptions($skinOption = 'option2', $faceOption = 'option1', $hairOption = 'option1', $hairColorOption = 'option1', $scarfOption = 'option1', $letterOption = 'D') {
    switch ($skinOption) {
        case 'option1':
            $skin = '1';
            break;
        case 'option2':
            $skin = '2';
            break;
        case 'option3':
            $skin = '3';
            break;
        default:
            $skin = '2';
            break;
    }
    switch ($faceOption) {
        case 'option1':
            $face = '1';
            break;
        case 'option2':
            $face = '2';
            break;
        default:
            $face = '1';
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
        case 'option6':
            $hair = '6';
            break;
        case 'option7':
            $hair = '7';
            break;
        case 'option8':
            $hair = '8';
            break;
        case 'option9':
            $hair = '9';
            break;
        case 'option10':
            $hair = '10';
            break;
        case 'option11':
            $hair = '11';
            break;
        case 'option12':
            $hair = '12';
            break;
        case 'option13':
            $hair = '13';
            break;
        case 'option14':
            $hair = '14';
            break;
        case 'option15':
            $hair = '15';
            break;
        default:
            $hair = '1';
            break;
    }
    switch ($hairColorOption) {
        case 'option1':
            $color = 'blonde';
            break;
        case 'option2':
            $color = 'red';
            break;
        case 'option3':
            $color = 'pink';
            break;
        case 'option4':
            $color = 'cyan';
            break;
        case 'option5':
            $color = 'black';
            break;
        case 'option6':
            $color = 'brown';
            break;
        case 'option7':
            $color = 'purple';
            break;
        default:
            $color = 'blonde';
            break;
    }
    switch ($scarfOption) {
        case 'option1':
            $scarf = '1';
            break;
        case 'option2':
            $scarf = '2';
            break;
        default:
            $scarf = '1';
            break;
    }
    $letter = $letterOption;
    return array($skin, $face, $hair, $color, $scarf, $letter);
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


list($skin, $face, $hair, $color, $scarf, $letter) = getOptions($_GET["optionsSkins"], $_GET["optionsFaces"], $_GET["optionsHairs"], $_GET["optionsHairColors"], $_GET["scarf"], $_GET["letter"]);
$haveGlass = $_GET["glass"];
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
$bgPath = 'images/background-xmas.jpg';
$skinPath = 'images/skin/' . $skin . '.png';
$letterPath = 'images/letter/' . $letter . '.png';
$facePath = 'images/face/' . $face . '.png';
$hairPath = 'images/hair/' . $hair . '.png';
$shirtPath = 'images/shirt/' . $shirt . '.png';
$scarfPath = 'images/scarf/' . $scarf . '.png';

switch ($color) {
    case 'blonde':
        $rgb = array(255 - 250, 255 - 246, 255 - 189);
        //   $rgb = array(250, 246, 189);
        break;
    case 'red':
        $rgb = array(255 - 228, 255 - 77, 255 - 46);
        // $rgb = array(228, 77, 46);
        break;
    case 'pink':
        $rgb = array(255 - 211, 255 - 3, 255 - 111);
        // $rgb = array(212, 71,153);
        break;
    case 'cyan':
        $rgb = array(255 - 101, 255 - 199, 255 - 198);
        // $rgb = array(101, 199,198);
        break;
    case 'black':
        $rgb = array(255 - 30, 255 - 30, 255 - 30);
        break;
     case 'brown':
        $rgb = array(255 - 119, 255 - 59, 255 - 50);
        break;
     case 'purple':
        $rgb = array(255 - 111, 255 - 43, 255 - 144);
        break;
    default:
        $rgb = array(255 - 250, 255 - 246, 255 - 189);
        break;
}

//create image
$bgImg = imagecreatefromjpeg($bgPath);
$shirtImg = imagecreatefrompng($shirtPath);
$skinImg = imagecreatefrompng($skinPath);
$letterImg = imagecreatefrompng($letterPath);
$faceImg = imagecreatefrompng($facePath);
$scarfImg = imagecreatefrompng($scarfPath);
$hairImg = imagecreatefrompng($hairPath);

//change hair color
//$rgb = array(255-$rgb[0],255-$rgb[1],255-$rgb[2]);
imagefilter($hairImg, IMG_FILTER_NEGATE);
imagefilter($hairImg, IMG_FILTER_COLORIZE, $rgb[0], $rgb[1], $rgb[2]);
imagefilter($hairImg, IMG_FILTER_NEGATE);
imagealphablending($hairImg, false);
imagesavealpha($hairImg, true);

//copy each png file on top of the destination (result) png
imagecopy($dest_image, $bgImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $shirtImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $skinImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $letterImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $faceImg, 0, 0, 0, 0, WIDTH, HEIGHT);
imagecopy($dest_image, $scarfImg, 0, 0, 0, 0, WIDTH, HEIGHT);

//Have glass
if ($haveGlass == "yes") {
    $glassPath = 'images/glass/glass.png';
    $glassImg = imagecreatefrompng($glassPath);
    imagecopy($dest_image, $glassImg, 0, 0, 0, 0, WIDTH, HEIGHT);
}

imagecopy($dest_image, $hairImg, 0, 0, 0, 0, WIDTH, HEIGHT);

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

//      $image = new PHPImage();
//     $image->draw($path);
//    $image->save($path, false, true);

echo $path;
?>
