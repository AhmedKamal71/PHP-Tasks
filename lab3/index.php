<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once("Visitors.php");
    include_once("config.php");
    $counter = new Visitors(myFile);
    $counter->counterFunction();
    ?>

</body>

</html>




<?php
