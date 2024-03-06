<?php

require_once("vendor/autoload.php");

$conn = new MainProgram;
$item = array();
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["id"])) {
    if ($conn->connect()) {
        $item = $conn->get_record_by_id($_GET["id"], "id");
    }
}

// Create Table Of All Data
if (!empty($item) > 0) {
    echo  '<table>';
    echo   '<tr>';
    echo '<th>' . "id" . '</th>';
    echo '<th>' . "code" . '</th>';
    echo '<th>' . "Type" . '</th>';
    echo '<th>' . "price" . '</th>';
    echo '<th>' . "rating" . '</th>';
    echo '<th>' . "Img" . '</th>';
    echo   '</tr>';

    echo   '<tr>';
    echo '<td>' . $item->id . '</td>';
    echo '<td>' . $item->PRODUCT_code . '</td>';
    echo '<td>' . $item->product_name . '</td>';
    echo '<td>' . $item->list_price . '</td>';
    echo '<td>' . $item->Rating . '</td>';
    echo '<td>' . "<img width='200' height='200' src='" . "/phpTasks/final_lab4/images/" . $item->Photo . "'>" . '</td>';
    echo   '</tr>';
    echo  '</table>';
}
$conn->disconnect();
?>

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

    input {
        border-radius: 20px;
    }
</style>