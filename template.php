<?php

$my_var = <<<EOD
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<h1> TEST </h1>
    
</body>
</html>
EOD;

// echo $my_var;

?>



<?php ob_start(); ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

<h1> Template </h1>
    
</body>
</html>
<?php $result = ob_get_clean();

echo $result; 
file_put_contents('/Applications/MAMP/htdocs/interscrollertemplate/result/result.html', $result);
?>