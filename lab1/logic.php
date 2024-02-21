<?php
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$textarea = isset($_POST["textarea"]) ? $_POST["textarea"] : "";

$message = "";

if (isset($_POST["submit"])) {
    if (empty($name) || empty($age) || empty($email) || empty($textarea)) {
        $message = "You Can not leave name or age or email empty!";
    } elseif (!is_numeric($age)) {
        $message =  "Please Enter a valid age!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please Enter A Valid Email!";
    } else {
        $message = "Thanks For Your Time";
    }
}
