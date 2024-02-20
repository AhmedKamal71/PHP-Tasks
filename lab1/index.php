<!----------------------------------------------------PHP---------------------------------------->
<?php
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$message = "";

if ($_POST["submit"]) {
    if (empty($name) || empty($age)) {
        $message = "You Can not leave name or age or email empty!";
    } elseif (!is_numeric($age)) {
        $message =  "Please Enter a valid age!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please Enter A Valid Email!";
    } else {
        $message = "Thanks For Your Time";
    }
}
?>
<!----------------------------------------------------HTML---------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
</head>

<body>
    <div>
        <h4><?php echo $message; ?></h4>
        <form action="index.php" method="post">
            <input type="text" name="name" value="<?php echo $name ?>" placeholder="name">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="email">
            <input type="text" name="age" value="<?php echo $age ?>" placeholder="age">
            <input name="textarea" value="" placeholder="message"></input>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>

</html>
<!----------------------------------------------------Style---------------------------------------->
<style>
    body {
        background-color: grey;
    }

    div {
        display: flex;
        border: 4px red solid;
        width: 300px;
        justify-content: center;
        text-align: center;
    }

    input {
        display: block;
        padding: 10px;
        margin: 5px;
        border-radius: 8px;
    }

    h4 {
        width: 100%;
        display: block;
    }
</style>