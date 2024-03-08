<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="display: flex; justify-content:center;">
        <form action="insert.php" method="POST">
            <label id="id" for="id">ID</label>
            <input name="id" type="text">

            <label for="code">Product Code</label>
            <input id="code" name="code" type="text">

            <label for="name">Product Name</label>
            <input id="name" name="name" type="text">

            <label for="img">Photo</label>
            <input id="img" name="img" type="text">

            <input class="sub" type="submit" name="submit">

        </form>
    </div>

</body>

</html>
<!-- -----------------------------------------PHP-------------------------------------------------------- -->
<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once("vendor/autoload.php");
$conn = new MainProgram;
$test = new Capsule();

$id = (isset($_POST["id"])) ? $_POST["id"] : "";
$code = (isset($_POST["code"])) ? $_POST["code"] : "";
$name = (isset($_POST["name"])) ? $_POST["name"] : "";
$img = (isset($_POST["img"])) ? $_POST["img"] : "";

$data = array("id" => $id, "PRODUCT_code" => $code, "product_name" => $name, "Photo" => $img);

if ($conn->connect()) {
    if (isset($_POST["submit"]) && $_POST["id"]) {
        $existingItem = Items::where('id', $data['id'])->first();
        if (!$existingItem) {
            $conn->insert_item($data);
        } else {
            echo "<div class='mess'>This Product is Already exists</div>";
        }
    }
}
$conn->disconnect();
?>
<!-- ----------------------------------------------Style-------------------------------------------- -->    
<style>
    body,
    h1,
    h2,
    p,
    form {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    h2 {
        color: #333;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        margin-top: 40px;
        width: 400px;
        border: 3px green solid;
        padding: 15px;
        border-radius: 5px;
    }

    label {
        margin-bottom: 8px;
        color: #555;
    }

    input,
    select {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .sub {
        background-color: green;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .error-message {
        color: #ff0000;
        margin-bottom: 10px;
    }

    .mess {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
</style>