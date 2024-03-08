<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="index.php" method="POST">
            <label for="column">Column Name</label>
            <input id="column" type="text" name="name_column">

            <label for="value">Value</label>
            <input id="value" type="text" name="value">

            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>

</html>

<?php
// PHP part

require_once("vendor/autoload.php");

$conn = new MainProgram;

$fields = ["id", "PRODUCT_code", "product_name"];
$items = [];

$page = isset($_GET["page"]) ? $_GET["page"] : 0;

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
    if ($_GET["click"] == "prev") {
        $page = max(0, $page - 5);
    } else if ($_GET["click"] == "next") {
        $page += 5;
    }
}

if ($conn->connect()) {
    $items = $conn->get_data($fields, $page);
    $product_id = $conn->get_url();
    $conn->handle_methods($items, $product_id);
} else {
    $response = ["error" => "Database not connected."];
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode($response);
}

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && isset($_POST["name_column"]) && isset($_POST["value"])) {
        $items = $conn->search_by_column($_POST["name_column"], $_POST["value"]);
    }
} catch (\Exception $e) {
    echo "<div class='mess'>Please Enter A Value</div>";
}

if (count($items) > 0) {
    echo '<table>';
    echo '<tr>';
    foreach ($fields as $field) {
        echo '<th>' . $field . '</th>';
    }
    echo '</tr>';
    foreach ($items as $item) {
        echo '<tr>';
        foreach ($fields as $field) {
            echo '<td>' . $item->$field . '</td>';
        }
        echo '<td>' . "<a href='getInfoGlasses.php/?id=$item->id'>" . "More" . "</a>" . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo "<div class='navigate'>";
    echo "<a class='prev' href='?click=prev&page=$page'>" . "&lt&ltPrev" . "</a>";
    echo "<a class='next' href='?click=next&page=$page'>" . "Next>>" . "</a>";
    echo "</div>";
    echo "<div>";
    echo "<button class='add'><a href='insert.php'>Add New Glass</a></button>";
    echo "</div>";
}

$conn->disconnect();
?>

<!-- ------------------------------------------------- Style------------------------------------------------- -->

<style>
    /* Reset some default styles */
    body,
    h1,
    h2,
    p,
    table {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 600px;
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

    table {
        width: 90%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-left: 40px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4caf50;
        color: #fff;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .mess {
        display: flex;
        justify-content: center;
        color: red;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif
    }


    a {
        color: #3498db;
        /* Link color */
        text-decoration: none;
        /* Remove underlines */
        transition: color 0.3s ease;
        /* Smooth color transition on hover */
    }

    a:hover {
        color: red;
    }

    .button-link {
        display: inline-block;
        padding: 10px 15px;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        /* Smooth background color transition on hover */
    }

    .button-link:hover {
        background-color: #2073b2;
        /* Change background color on hover */
    }

    .add {
        background-color: green;
        height: 30px;
        width: 200px;
        margin-left: 550px;
        margin-bottom: 200px;
        border: none;
        border-radius: 5px;
    }

    .add a {
        color: white;
    }

    .prev {
        margin-left: 480px;
        margin-right: 10px;
    }
</style>