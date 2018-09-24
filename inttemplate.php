<html>
    <head><link rel="stylesheet" type="text/css" href="style.css"></head>
    <body>
        <h1>Interscroller Template</h1>
        <div class="container">
            <form action="inttemplate.php" method="post" enctype="multipart/form-data">
                Click-URL: <input type="text" name="url"><br>
                Upload Image: <input type="file" name="fileToUpload" id="fileToUpload"> <br>
                Tracking Pixel: <input type="text" name="track"><br>
            <input type="submit" value="click" name="submit">
            </form>
        </div>
    </body>
</html>


<?php 

//Turn errors off by outcommenting the follow line of code:
error_reporting(E_ALL ^ E_NOTICE); 

// Input variables for HTML-Template
$clickurl = $_POST["url"];
$trackingpixel = $_POST["track"];
$filename=$_FILES['fileToUpload']['name'];

// Output Buffer: store HTML code in PHP-variable
ob_start(); ?>

<!--HTML goes here-->


<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body style="margin:0px;padding:0px;background:#b9c5c3;">
	<a href="<?php echo $clickurl ?>" target="_blank">
		<div style="width:100vw;height:100vh;overflow:hidden;background-color:#009fe4;">
			<img src="<?php echo $filename?>" width="300" height="500" style="height:auto;width:100%;margin-left:auto;margin-right:auto;"/>
        </div>
    </a>
    <img src="<?php echo $trackingpixel ?>" border="0" width="1" height="1"/>
</body>
</html>


<!--HTML ends here-->

<?php 
$result = ob_get_clean();
//echo $result; 

// Set Time zone
date_default_timezone_set('Europe/Copenhagen');
// Get current time
$datetime = (new \DateTime())->format('Y-m-d_H:i:s');
$path = '/Applications/MAMP/htdocs/interscrollertemplate/template/' . $datetime. '/';

// If Form is submitted:
  if(isset($_POST['submit']))
    {
        // Create directory and place result HTML-file in said directory
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        file_put_contents($path . 'int.html', $result);
    } 

?>



<?php

// File Upload Script

$target_dir = "$path";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>