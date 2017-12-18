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
        createimageinstantly();
        //$targetFolder = '/gw/media/uploads/processed/';
        //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
        //$img3 = $targetPath.'img3.png';
        //print_r(getimagesize('http://www.vapor-rage.com/wp-content/uploads/2014/05/sample.jpg'));
        function createimageinstantly($img1='',$img2='',$img3=''){
            $x=$y=600;
            header('Content-Type: image/png');
            $targetFolder = 'images/';
            $targetPath = $targetFolder;//$_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            echo $targetPath;

            $img1 = $targetPath.'logo.png';
            $img2 = $targetPath.'SendYourOwlButton.png';
            $img3 = $targetPath.'20Yrs.png';

            $outputImage = imagecreatetruecolor(600, 600);

            // set background to white
            $white = imagecolorallocate($outputImage, 255, 255, 255);
            imagefill($outputImage, 0, 0, $white);

            $first = imagecreatefrompng($img1);
            $second = imagecreatefrompng($img2);
            $third = imagecreatefrompng($img3);

            //imagecopyresized ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
            imagecopyresized($outputImage,$first,0,0,0,0, $x, $y,$x,$y);
            imagecopyresized($outputImage,$second,0,0,0,0, $x, $y,$x,$y);
            imagecopyresized($outputImage,$third,200,200,0,0, 100, 100, 204, 148);

            // Add the text
            //imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
            //$white = imagecolorallocate($im, 255, 255, 255);
          //  $text = 'School Name Here';
          // $font = 'OldeEnglish.ttf';
           // imagettftext($outputImage, 32, 0, 150, 150, $white, $font, $text);

            $filename =$targetPath .round(microtime(true)).'.png';
         //   $path = "avas/" . generateRandomString(4) . "_" . $filename . ".jpg";
         //   $image = new PHPImage();
         //   $image->save($path, false, true);
            
            imagepng($outputImage, $filename);

            imagedestroy($outputImage);
        }
    ?>

<div class="fill">	
    <?php echo $targetPath?>
		<a href="<?php echo $targetPath?>" download>
			<img class="image" src="<?php echo $targetPath?>" alt="#sendyourowl">
		</a>
	</div>
</body>
</html>