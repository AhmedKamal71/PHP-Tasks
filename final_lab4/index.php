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
<!---------------------------------------------------PHP--------------------------------------------------->
<?php
require_once("vendor/autoload.php");
$conn = new MainProgram;              // Create Object From The Main Class
$fields = ["id", "PRODUCT_code",  "product_name"];     // Array of data attributes
$items = array();
$page = isset($_GET["page"]) ? $_GET["page"] : 0;      // Page Navigator 
if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
    if ($_GET["click"] == "prev") {
        if ($page > 0) {
            $page -= 5;
            if ($page < 0) $page = 0;
        }
    } else if ($_GET["click"] == "next") {
        $page += 5;
    }
}

// Check if the connect function return true
if ($conn->connect()) {
    $items = $conn->get_data($fields, $page);
}
// Search in specific column using specific value
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"], $_POST["name_column"], $_POST["value"])) {
    $items = $conn->search_by_column($_POST["name_column"], $_POST["value"]);
}

// Create Table Of Data
if (count($items) > 0) {
    echo '<table >';
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
        echo   '</tr>';
    }
    echo  '</table>';
    echo "<div class='navigate'>";
    echo "<a style='margin-right:10px' href='?click=prev&page=$page'>" . "&lt&ltPrev" . "</a>";
    echo "<a href='?click=next&page=$page'>" . "Next>>" . "</a>";
    echo "</div>";
}
$conn->disconnect();
?>