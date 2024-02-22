<?php
require_once("functions.php");
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$textarea = isset($_POST["textarea"]) ? $_POST["textarea"] : "";
$message = "";

if (isset($_POST["submit"])) {
    if (empty($name) || empty($age) || empty($email) || empty($textarea)) {
        $message = "You Must Fill All Fields!";
    } elseif (!is_numeric($age)) {
        $message =  "Please Enter a valid age!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please Enter A Valid Email!";
    } elseif (strlen($name) > 100) {
        $message = "Please the name must be less than 100 characters";
    } elseif (strlen($textarea) >= 250) {
        $message = "Please the text message must be less than 25s0 characters";
    } else {
        echo "<div>Contact Was Added Successfully</div><br>";
        if (add_to_file_submites($name, $age, $email, $textarea)) {
            die(display_file());
        }
    }
}
