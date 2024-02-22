<?php require_once("logic.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="parent">
        <form action="index.php" method="post">
            <h4><?php echo $message; ?></h4>
            <input type="text" name="name" value="<?php echo $name ?>" placeholder="name">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="email">
            <input type="text" name="age" value="<?php echo $age ?>" placeholder="age">
            <textarea name="textarea" value="<?php echo $textarea ?>" placeholder="message"></textarea>
            <input id="submit" type="submit" name="submit" value="Submit">
            <input id="clear" name="clear" type="reset" value="clear form" />
        </form>
    </div>
</body>

</html>