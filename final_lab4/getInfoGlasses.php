<?php

require_once("vendor/autoload.php");

$conn = new MainProgram;
$item = array();
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["id"])) {
    if ($conn->connect()) {
        $item = $conn->get_record_by_id($_GET["id"], "id");
    }
}


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
    body {
        background-color: aliceblue;
        display: flex;
        align-items: center;
        padding-left: 300px;
    }

    table,
    th,
    td {
        border: 2px green solid;
        text-align: center;
        border-radius: 5px;
    }
</style>