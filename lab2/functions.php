<?php
require_once("config.php");
function add_to_file_submites($name, $age, $email, $textarea)
{
    $fb = fopen(submites_file, "a+");
    if ($fb) {
        $input = date("Y-m-d M:i:s") . "," . $_SERVER["REMOTE_ADDR"] . "," . "$name,$age,$email,$textarea" . PHP_EOL;
        if (fwrite($fb, $input)) {
            fclose($fb);
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function display_file()
{
    $lines = file("submites.txt");
    $i = 0;
    foreach ($lines as $line) {
        echo "-------------- New User Submit -------------";
        $words = explode(",", $line);
        foreach ($words as $word) {
            if ($i == 0) {
                echo "<h5>Date: $word</h5>";
            } elseif ($i == 1) {
                echo "<h5>IP Adderss: $word</h5>";
            } elseif ($i == 2) {
                echo "<h5>Name: $word</h5>";
            } elseif ($i == 3) {
                echo "<h5>Age: $word</h5>";
            } elseif ($i == 4) {
                echo "<h5>Email: $word</h5>";
            } elseif ($i == 5) {
                echo "<h5>Text: $word</h5>";
            }
        }
        $i++;
    }
}
