<?php
include 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $lang['PAGE_TITLE']; ?></title>
        <link rel="stylesheet" href="styles/styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:url"                content="https://hogwarts.vn/SendYourOwl" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="SendYourOwl - Hogwarts.vn" />
        <meta property="og:description"        content="Tạo và chia sẻ thư cú của bạn ngay để nhận ngay thư nhập học hoặc phần quà lưu niệm nhé bồ tèo!" />
        <meta property="og:image"              content="http://i.imgur.com/Q9g447d.png" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="bootstrap-maxlength.min.js"></script>
        <script src="highlight.pack.js"></script>
        <style>
            body {
                width: 100%;
                height:90%;
            }
        </style>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {

                $('#xmasForm').change(function () {
                    skin_value = $("input[name='optionsSkins']:checked").val();
                    face_value = $("input[name='optionsFaces']:checked").val();
                    hair_value = $("input[name='optionsHairs']:checked").val();
                    color_value = $("input[name='optionsHairColors']:checked").val();
                    scarf_value = $("input[name='optionsScarfs']:checked").val();
                    //   alert('Shirt: ' + shirt_value + ' - Hair: ' + hair_value);

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // alert(this.responseText);
                            document.getElementById("preview-image").src = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "image-xmas.php?optionsSkins=" + skin_value + 
                            "&optionsFaces=" + face_value + "&optionsHairs=" + hair_value +
                            "&optionsHairColors=" + color_value + "&optionsScarfs=" + scarf_value, true);
                    xmlhttp.send();

                    /*$.ajax({
                     url: 'image-xmas.php',
                     type: 'POST',
                     dataType: 'json',
                     'success': function (response) {
                     if (response.status == 'success') {
                     lastInput = rdio.val();
                     } else {
                     $('input[name="radio_group"][value="' + lastInput + '"]').prop('checked', true);
                     }
                     },
                     });*/
                });

            });

            function downloadImage() {
                var urlImage = document.getElementById("preview-image").src;
                var d = new Date();
                var month = d.getMonth() + 1;
                var fileName = d.getFullYear() + "" + month + "" + d.getDate() + "" + d.getTime() + ".jpg"; 
                var a = document.createElement('a');
                a.href = urlImage;
                a.download = fileName;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }

        </script>
    </head>
    <body>
        <?php
        $text = "What are you doing?";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $text = test_input($_POST["yourowl"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <div style="width: 90%; margin: auto;" class="container-fluid">
            <div class="bg-3 text-center">
                <h3><b><?php echo $lang['HEADER_TITLE_H3_TOP']; ?></b></h3>
                <img src="images/logo.png" class="img-circle" width="30%" height="30%" alt="Bird">
                <h3>#WeasleyJumper #XmasHogwartsVietnam</h3>
            </div>

            <div style="width: 90%; margin: auto;" class="container-fluid">

                <form style="width: 70%" class="ajax-call" id="xmasForm" action="image-xmas.php" method="get" role="form">
                    <br/><br/>
                    
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $lang['LB_CHOOSE_SKIN']; ?></label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="optionsSkins" id="optionsRadios1" value="option1" checked>
                                Sáng
                                <?php //echo $lang['OWL_1']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsSkins" id="optionsRadios2" value="option2">
                                Trung 
                                <?php // echo $lang['OWL_2']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsSkins" id="optionsRadios3" value="option3">
                                Đen
                                <?php //echo $lang['OWL_3']; ?>
                            </label><br><br>
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $lang['LB_CHOOSE_FACE']; ?></label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="optionsFaces" id="optionsRadios1" value="option1" checked>
                                Lườm
                                <?php //echo $lang['OWL_1']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsFaces" id="optionsRadios2" value="option2">
                                Mếu
                                <?php // echo $lang['OWL_2']; ?>
                            </label><br><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $lang['LB_CHOOSE_HAIR']; ?></label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="optionsHairs" id="optionsRadios1" value="option1" checked>
                                Tóc Malfoy
                                <?php //echo $lang['BG_1']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsHairs" id="optionsRadios5" value="option2">
                                Tóc Weasley
                                <?php //echo $lang['BG_5']; ?>
                            </label><br><br>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $lang['LB_CHOOSE_HAIR_COLOR']; ?></label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="optionsHairColors" id="optionsRadios1" value="option1" checked>
                                Vàng
                                <?php //echo $lang['BG_1']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsHairColors" id="optionsRadios5" value="option2">
                                Đỏ
                                <?php //echo $lang['BG_5']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsHairColors" id="optionsRadios2" value="option3">
                                Đen
                                <?php //echo $lang['BG_5']; ?>
                            </label><br><br>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php echo $lang['LB_CHOOSE_SCARF']; ?></label>
                        <div class="col-sm-10">
                            <label>
                                <input type="radio" name="optionsScarfs" id="optionsRadios1" value="option1" checked>
                                Slytherin
        
                                <?php //echo $lang['BG_1']; ?>
                            </label><br>
                            <label>
                                <input type="radio" name="optionsScarfs" id="optionsRadios2" value="option2">
                                 Gryffindors
                                <?php //echo $lang['BG_5']; ?>
                            </label><br><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <input id="btn-download" name="btnDownload" onclick="downloadImage()" type="button" value="<?php echo $lang['BUTTON_CREATE_XMAS']; ?>" class="btn btn-default">
                        </div>
                    </div>

                </form>


                <img id="preview-image" src="images/default3.png" class="img-circle" width="30%" height="30%" download="myImage">

            </div>
        </div>
    </body>
</html>
